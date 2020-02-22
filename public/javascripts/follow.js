window.addEventListener('load',()=>{
    let search = document.getElementById('search');
    search.addEventListener('input',()=>{
        let buttons = document.getElementsByClassName('follow');
        console.log(buttons);
    })
    /*function run(){
        console.log('abc');
    }*/
    function ajaxFollow(followedName){
        let xhr = new XMLHttpRequest();
        xhr.open('GET',`../ajax/ajax.search.php/?followedName=${followedName}`,true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200 && this.responseText!=null){
                dropdown.innerHTML = this.responseText;
            }
        }
        xhr.send();
    }
});