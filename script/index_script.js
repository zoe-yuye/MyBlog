let dropdown_menu = document.querySelector('.dropdown_menu');
let toggle_btn = document.querySelector('.toggle_btn');

toggle_btn.addEventListener('click', function(event) {
  
    dropdown_menu.classList.toggle('show-menu');
});
let theme = document.getElementById('theme');
let light =document.getElementById('light');
let isLightTheme = true;
light.addEventListener('click', function(event){
    if(isLightTheme){
        theme.href = 'css/head_footer_style_dark.css';
    }else{
        theme.href = 'css/head_footer_style.css';
    }
    isLightTheme = !isLightTheme;
    
});
let audio = document.querySelector('audio');
let music = document.getElementById('music');
let mute = document.getElementById('mute');
music.addEventListener('click', function () {
    if (audio.paused) {
        audio.play();
        mute.style.display ='none';
    } else {
        audio.pause();
        mute.style.display ='inline';
    }
});

let backtop = document.getElementById('backtop');

backtop.addEventListener('click', function (event){
    document.documentElement.scrollTop = 0;
});
// let logout = document.getElementById('logout');
