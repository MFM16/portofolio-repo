let baseUrl =  window.location.origin;
let lang = $('meta[name="lang"]').attr('content')
const language = {
    "search": lang == 1 ? 'Search :' : 'Cari :',
    "emptyTable": lang == 1 ? 'No data available in table :' : 'Tidak ada data tersedia',
    "paginate": {
        "first": lang == 1 ? 'First' : 'Pertama',
        "last": lang == 1 ? 'Last' : 'Terakhir',
        "next": lang == 1 ? 'Next' : 'Selanjutnya',
        "previous": lang == 1 ? 'Previous' : 'Sebelumnya'
    },
    "info": lang == 1 ? 'Showing _START_ to _END_ of _TOTAL_ entries' : 'Memperlihatkan data dari _START_ sampai _END_ dari _TOTAL_ total data',
    "infoEmpty": lang == 1 ? 'Showing 0 to 0 of 0 entries' : 'Memperlihatkan data dari 0 sampai 0 dari 0 total data',
    "lengthMenu": lang == 1 ? "Show _MENU_ entries" : 'Memperlihatkan _MENU_ data',
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function formData(data)
{
    let validData = new FormData()
    $.each(data, (index, value) => {
        validData.append(`${index}`, value)
    })
    return validData
}

function post(url, data, redirect)
{
    let validData = formData(data)

    $.ajax({
        url : `${baseUrl}/${url}`,
        type: 'POST',
        data : validData,
        cache : false,
        contentType : false,
        processData : false,
        success: (response) => {
            if (url == 'admin/auth') {
                const data = response.data
                if (data.role == 1) {
                    window.location.href = `${baseUrl}${redirect}`
                } else {
                    window.location.href = `${baseUrl}/admin/portofolio`
                }
            }else{
                const status = response.status
                let title
                let subTitle
                lang == 1 ? title = response.title_en : title = response.title_id
                lang == 1 ? subTitle = response.sub_title_en : title = response.sub_title_id
                Swal.fire({
                    title : title,
                    text : subTitle,
                    icon : status
                }).then((result) => {
                    if(result.value){
                        window.location.href = `${baseUrl}${redirect}`
                    }
                })
            }
        },
        error: (response) => {
            const jsonResponse = response.responseJSON
            const status = jsonResponse.status
            let title
            let subTitle
            lang == 1 ? title = jsonResponse.title_en : title = jsonResponse.title_id
            lang == 1 ? subTitle = jsonResponse.sub_title_en : title = jsonResponse.sub_title_id
            
            if(url == 'admin/registration'){
                Swal.fire({
                    title : title,
                    text : subTitle,
                    icon : status
                }).then((result) => {
                    if(result.value){
                        $('#registration_button').removeAttr('disabled', false)
                    }
                })
            }else{
                Swal.fire({
                    title : title,
                    text : subTitle,
                    icon : status
                })
            }
        }
    })
}

function del(url)
{
    Swal.fire({
        title: lang == 1 ? 'Are you sure?' : 'Apakah anda yakin?',
        text:lang == 1 ? "You won't be able to revert this!" : 'Data yang sudah dihapus tidak dapat dikembalikan',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3b82f6',
        cancelButtonColor: '#f53939',
        confirmButtonText: lang == 1 ? 'Yes, delete it!' : 'Ya, hapus',
        cancelButtonText: lang == 1 ? 'Cancel' : 'Batal',
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : `${baseUrl}/${url}`,
                type: 'DELETE',
                success: (response) => {
                    const status = response.status
                    let title
                    let subTitle
                    lang == 1 ? title = response.title_en : title = response.title_id
                    lang == 1 ? subTitle = response.sub_title_en : title = response.sub_title_id
                    Swal.fire({
                        title : title,
                        text : subTitle,
                        icon : status
                    }).then((result) => {
                        if(result.value){
                            location.reload() 
                        }
                    })
                },
                error: (response) => {
                    const jsonResponse = response.responseJSON
                    const status = jsonResponse.status
                    let title
                    let subTitle
                    lang == 1 ? title = jsonResponse.title_en : title = jsonResponse.title_id
                    lang == 1 ? subTitle = jsonResponse.sub_title_en : title = jsonResponse.sub_title_id
                    Swal.fire({
                        title : title,
                        text : subTitle,
                        icon : status
                    })
                }
            })
        }
      })
}

function get(url)
{
    var data
    $.ajax({
        url : `${baseUrl}/${url}`,
        type: 'GET',
        async : false,
        success: (response) => {
            data = response.data
        },
        error: (response) => {
            const jsonResponse = response.responseJSON
            const status = jsonResponse.status
            let title
            let subTitle
            lang == 1 ? title = jsonResponse.title_en : title = jsonResponse.title_id
            lang == 1 ? subTitle = jsonResponse.sub_title_en : title = jsonResponse.sub_title_id
            Swal.fire({
                title : title,
                text : subTitle,
                icon : status
            })
        }
    })
    return data
}

function openModal(modalTitle){
    window.scrollTo(0, 0)
    $('.modal-title').text(modalTitle)
    modal.classList.toggle('hidden')
    body.classList.toggle('overflow-hidden')
}

$('#registration_button').on('click', () => {
    data = {
        email : $('#email').val(),
        password : $('#password').val(),
        verifyPassword : $('#verifyPassword').val()
    }
    post('admin/registration', data, '/admin/auth')
})

$('#login_button').on('click', () => {
    data = {
        email : $('#email').val(),
        password : $('#password').val()
    }
    post('admin/auth', data, '/admin/dashboard')
})

$('#edit-profile').on('click', () => {
    var id = $('#id_profile').val()
    const data = get(`admin/profile/show/${id}`)
    $('#name').val(data.name)
    $('#nickname').val(data.nickname)
    $('#address').val(data.address)
    $('#biography').val(data.biography)
    $('#job').val(data.job)
    $('#job_description').val(data.job_description)

    openModal(lang == 1 ? 'Update Profile' : 'Perbaharui Profil')
})

$('#btn-edit-profile').on('click', () => {
    data = {
        id : $('#id_profile').val(),
        name : $('#name').val(),
        nickname : $('#nickname').val(),
        address : $('#address').val(),
        bio : $('#biography').val(),
        job : $('#job').val(),
        jobdesc : $('#job_description').val(),
        _method : 'PUT'
    }
    $('#photo').prop('files')[0] ? data.photo = $('#photo').prop('files')[0] : ''
    $('#logo').prop('files')[0] ? data.logo = $$('#logo').prop('files')[0] : ''

    post('admin/profile', data, '/admin/profile')
})

// Social CRUD

$('#social-datatable').DataTable({
    processing: true,
    serverSide: true,
    language: language,
    ajax: `${baseUrl}/admin/social`,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'url', name: 'url'},
        {data: 'logo', name: 'logo',
        "render": function (data) {        
            return `<i class="${data}"></i>`
        }
        },
        {data: 'action', name: 'action'},

    ]
});

$(document).delegate('#delete-social', 'click', function() {
    var id = $(this).data('id')
    del(`admin/social/delete/${id}`)
})

$(document).delegate('#edit-social', 'click', function() {
    var id = $(this).data('id')
    $('#process').val('edit')
    const data = get(`admin/social/show/${id}`)
    $('#name').val(data.name)
    $('#url').val(data.url)
    $('#id_social').val(data.id)
    $('#logo').val(data.logo);

    openModal('Edit Social Media Account')
})

$('#btn-social').on('click', () => {
    var process = $('#process').val()
    data = {
        id : $('#id_profile').val(),
        name : $('#name').val(),
        url : $('#url').val(),
        logo : $('#logo').val()
    }

    if(process == 'edit'){
        data._method = 'PUT'
        data.id_social = $('#id_social').val()
    }

    post('admin/social', data, '/admin/social')
})

// Icon CRUD
$('#logo-datatable').DataTable({
    processing: true,
    serverSide: true,
    language: language,
    ajax: `${baseUrl}/admin/logo`,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'icon', name: 'icon',
        "render": function (data) {        
            return `<i class="${data}"></i>`
        }
        },
        {data: 'action', name: 'action'},

    ]
});

$(document).delegate('#delete-icon', 'click', function() {
    var id = $(this).data('id')
    del(`admin/logo/delete/${id}`)
})

$(document).delegate('#edit-icon', 'click', function() {
    var id = $(this).data('id')
    $('#process').val('edit')
    const data = get(`admin/logo/show/${id}`)
    $('#name').val(data.name)
    $('#icon').val(data.icon)
    $('#id').val(data.id)

    openModal('Edit Social Media Logo')
})

$('#btn-icon').on('click', () => {
    var process = $('#process').val()
    data = {
        name : $('#name').val(),
        icon : $('#icon').val(),
    }

    if(process == 'edit'){
        data._method = 'PUT'
        data.id = $('#id').val()
    }

    post('admin/logo', data, '/admin/logo')
})

// Skill CRUD
$('#skill-datatable').DataTable({
    processing: true,
    serverSide: true,
    language: language,
    ajax: `${baseUrl}/admin/skill`,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'photo', name: 'photo',
        "render": function (data) {        
            return `<i class="${data}"></i>`
        }
        },
        {data: 'action', name: 'action'},

    ]
});

$(document).delegate('#delete-skill', 'click', function() {
    var id = $(this).data('id')
    del(`admin/skill/delete/${id}`)
})

$(document).delegate('#edit-skill', 'click', function() {
    var id = $(this).data('id')
    $('#process').val('edit')
    const data = get(`admin/skill/show/${id}`)
    $('#name').val(data.name)
    $('#logo').val(data.photo)
    $('#id_skill').val(data.id)

    openModal('Edit Skill')
})

$('#btn-skill').on('click', () => {
    var process = $('#process').val()
    data = {
        name : $('#name').val(),
        logo : $('#logo').val(),
    }

    if(process == 'edit'){
        data._method = 'PUT'
        data.id = $('#id_skill').val()
    }

    if(process == 'add'){
        data.profile_id = $('#id_profile').val()
    }
    post('admin/skill', data, '/admin/skill')
})

// Portofolio CRUD
$('#portofolio-datatable').DataTable({
    processing: true,
    serverSide: true,
    language: language,
    ajax: `${baseUrl}/admin/portofolio`,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'description', name: 'description'},
        {data: 'thumbnail', name: 'thumbnail',
        "render": function (data) {        
            return `<img src="${baseUrl}/storage/${data}" class="w-30 h-20" />`
        }
        },
        {data: 'action', name: 'action'},
    ]
});

$(document).delegate('#delete-portofolio', 'click', function() {
    var id = $(this).data('id')
    del(`admin/portofolio/delete/${id}`)
})

$(document).delegate('#edit-portofolio', 'click', function() {
    var id = $(this).data('id')
    $('#process').val('edit')
    const data = get(`admin/portofolio/show/${id}`)
    $('#name').val(data.name)
    $('#description').val(data.description)
    editor.setData(data.full_description)
    $('#id').val(data.id)

    openModal('Edit Portofolio')
})

$('#btn-portofolio').on('click', () => {
    var process = $('#process').val()
    data = {
        name : $('#name').val(),
        description : $('#description').val(),
        full_description : editor.getData(),
    }
    $('#thumbnail').prop('files')[0] ? data.thumbnail = $('#thumbnail').prop('files')[0] : ''

    if(process == 'edit'){
        data._method = 'PUT'
        data.id = $('#id').val()
    }

    if(process == 'add'){
        data.profile_id = $('#profile_id').val()
    }

    post('admin/portofolio', data, '/admin/portofolio')
})

// Post CRUD
$('#post-datatable').DataTable({
    processing: true,
    serverSide: true,
    language: language,
    ajax: `${baseUrl}/admin/post`,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'description', name: 'description'},
        {data: 'thumbnail', name: 'thumbnail',
        "render": function (data) {        
            return `<img src="${baseUrl}/storage/${data}" class="w-30 h-20" />`
        }
        },
        {data: 'action', name: 'action'},
    ]
});

$(document).delegate('#delete-post', 'click', function() {
    var id = $(this).data('id')
    del(`admin/post/delete/${id}`)
})

$(document).delegate('#edit-post', 'click', function() {
    var id = $(this).data('id')
    $('#process').val('edit')
    const data = get(`admin/post/show/${id}`)
    $('#name').val(data.name)
    $('#description').val(data.description)
    editor.setData(data.full_description)
    $('#id').val(data.id)

    openModal('Edit Post')
})

$('#btn-post').on('click', () => {
    var process = $('#process').val()
    data = {
        name : $('#name').val(),
        description : $('#description').val(),
        full_description : editor.getData(),
    }
    $('#thumbnail').prop('files')[0] ? data.thumbnail = $('#thumbnail').prop('files')[0] : ''

    if(process == 'edit'){
        data._method = 'PUT'
        data.id = $('#id').val()
    }

    if(process == 'add'){
        data.profile_id = $('#profile_id').val()
    }

    post('admin/post', data, '/admin/post')
})

// Client CRUD
$('#client-datatable').DataTable({
    processing: true,
    serverSide: true,
    language: language,
    ajax: `${baseUrl}/admin/client`,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'photo', name: 'photo',
        "render": function (data) {        
            return `<img src="${baseUrl}/storage/${data}" class="w-30 h-20" />`
        }
        },
        {data: 'action', name: 'action'},
    ]
});

$(document).delegate('#delete-client', 'click', function() {
    var id = $(this).data('id')
    del(`admin/client/delete/${id}`)
})

$(document).delegate('#edit-client', 'click', function() {
    var id = $(this).data('id')
    $('#process').val('edit')
    const data = get(`admin/client/show/${id}`)
    $('#name').val(data.name)
    $('#id').val(data.id)

    openModal('Edit Client')
})

$('#btn-client').on('click', () => {
    var process = $('#process').val()
    data = {
        name : $('#name').val(),
    }
    $('#photo').prop('files')[0] ? data.photo = $('#photo').prop('files')[0] : ''

    if(process == 'edit'){
        data._method = 'PUT'
        data.id = $('#id').val()
    }

    if(process == 'add'){
        data.profile_id = $('#profile_id').val()
    }

    post('admin/client', data, '/admin/client')
})

$('#btn-setting').on('click', () => {
    var data = {
        id : $('#setting_id').val(),
        lang : $("#lang").is(":checked") ? $('#lang:checked').val() : 0,
        client : $("#client").is(":checked") ? $('#client:checked').val()  : 0,
        blog : $("#blog").is(":checked") ? $('#blog:checked').val() : 0,
        _method : 'PUT'
    }

    post('admin/setting', data, '/admin/profile')
})

$('#feedback-datatable').DataTable({
    processing: true,
    serverSide: true,
    language: language,
    ajax: `${baseUrl}/admin/feedback`,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'category', name: 'category'},
        {data: 'content', name: 'content'},
        {data: 'action', name: 'action'},

    ]
});

$('#btn-feedback').on('click', () => {
    data = {
        category : $('#category').val(),
        content : $('#content').val(),
    }

    post('admin/feedback', data, '/admin/feedback')
})

$(document).delegate('#detail-feedback', 'click', function() {
    var id = $(this).data('id')
    const data = get(`admin/feedback/show/${id}`)
    $('#category').val(data.category)
    $('#content').val(data.content)

    console.log(data.category)

    openModal(lang == 1 ? 'Detail Feedback' : 'Rincian Ulasan')
})