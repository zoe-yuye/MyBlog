let swift1 = document.getElementById('swift1');
let swift2 = document.getElementById('swift2');
let slide = document.getElementById('slide');
swift2.addEventListener('click', function (event) {
    let lists = document.querySelectorAll('.item');
    slide.appendChild(lists[0]);
});
swift1.addEventListener('click', function (event) {
    let lists = document.querySelectorAll('.item');
    
    slide.prepend(lists[lists.length - 1]);
});