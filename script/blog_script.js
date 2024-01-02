let form = document.getElementById('comment');
let comment_btn = document.getElementById('comment_btn');
let display = false;
comment_btn.addEventListener('click', function(event){
    if (!display) {
        form.style.display = 'block'; 
        display = true;
    } else {
        form.style.display = 'none'; 
        display = false;
    }
});
