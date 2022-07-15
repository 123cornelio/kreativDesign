let perBtn = document.querySelector('.perfilContainer')
let perfil = document.querySelector('.adm-info')
let close = document.querySelector('.close')

perfil.addEventListener('click',()=>{
    perBtn.classList.add('perfilShow')
})
close.addEventListener('click',()=>{
    perBtn.classList.remove('perfilShow')
})
