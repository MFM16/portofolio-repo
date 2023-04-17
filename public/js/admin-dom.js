const profile = document.querySelector('#profile')
const profileDropdown = document.querySelector('#profile-dropdown')
const modal = document.querySelector('#modal')
const editProfile = document.querySelector('#edit-profile')
const btnModal= document.querySelector('#btn-modal')
const btnCloseModal = document.querySelector('#btn-close-modal')
const body = document.querySelector('#body')

profile.addEventListener('click', () => {
    profileDropdown.classList.toggle('hidden');
});

btnCloseModal.addEventListener('click', () => {
    modal.classList.toggle('hidden')
    body.classList.toggle('overflow-hidden')
})

btnModal.addEventListener('click', () => {
    document.getElementById('form-modal').reset()
    if(typeof editor !== 'undefined'){
        editor.setData('')
    }
    $('#process').val('add')
    window.scrollTo(0, 0)
    modal.classList.toggle('hidden')
    body.classList.toggle('overflow-hidden')
})