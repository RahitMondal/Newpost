window.addEventListener('load',()=>{
    let post_btn = document.getElementById('post_btn');
    let post_desc = document.getElementById('post_desc');
    let user_posts = document.getElementById('user-posts');
    let search = document.getElementById('search');
    let dropdown = document.getElementsByTagName('dropdown')[0];
    let following = document.getElementById('following');
    let followers = document.getElementById('followers');
    post_btn.addEventListener('click',()=>{
        ajaxRequest(post_desc.value);
    });

    search.addEventListener('input',()=>{
        ajaxSearch(search.value);
    });

    following.addEventListener('click',()=>{
        ajaxFollowing();
    });

    followers.addEventListener('click',()=>{
        ajaxFollowers();
    });

    function ajaxRequest(value){
        let xhr = new XMLHttpRequest();
        xhr.open('POST','../ajax/ajax.post.php',true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
                if(this.responseText){
                    user_posts.innerHTML = this.responseText;    
                }else{
                    user_posts.innerHTML = '<h3 id=\'first_msg\'>Start following people!</h3>';
                }
                
                post_desc.value='';
            }
        }
        xhr.send(`post_desc=${value}`);
    }

    function ajaxSearch(key){
        let xhr = new XMLHttpRequest();
        xhr.open('GET',`../ajax/ajax.search.php/?key=${key}`,true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200 && this.responseText!=null){
                dropdown.innerHTML = this.responseText;
                dropdown.style.display = 'block';
                let buttons = document.getElementsByClassName('follow');
                for(let i=0 ; i<buttons.length ; i++){
                    buttons[i].addEventListener('click',()=>{
                        console.log(buttons[i].value);
                        ajaxFollow(buttons[i].value,buttons[i]);
                    })
                }
            }
        }
        xhr.send();

    }

    function ajaxFollowing(){
        let xhr = new XMLHttpRequest();
        xhr.open('GET',`../ajax/ajax.following.php/?`,true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200 && this.responseText!=null){
                dropdown.innerHTML = this.responseText;
                dropdown.style.display = 'block';
                let buttons = document.getElementsByClassName('unfollow');
                for(let i=0 ; i<buttons.length ; i++){
                    buttons[i].addEventListener('click',()=>{
                        console.log(buttons[i].value);
                        ajaxFollow(buttons[i].value,buttons[i]);
                    })
                }
            }
        }
        xhr.send();
    }

    function ajaxFollowers(){
        let xhr = new XMLHttpRequest();
        xhr.open('GET',`../ajax/ajax.followers.php/?`,true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200 && this.responseText!=null){
                dropdown.innerHTML = this.responseText;
                dropdown.style.display = 'block';
                let buttons = document.getElementsByClassName('follow');
                for(let i=0 ; i<buttons.length ; i++){
                    buttons[i].addEventListener('click',()=>{
                        console.log(buttons[i].value);
                        ajaxFollow(buttons[i].value,buttons[i]);
                    })
                }
            }
        }
        xhr.send();
    }

    function ajaxFollow(followedPerson,buttonRef){
        let xhr = new XMLHttpRequest();
        xhr.open('GET',`../ajax/ajax.follow.php/?followed_person=${followedPerson}`,true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200 && this.responseText!=null){
                buttonRef.innerHTML = 'Following';
                buttonRef.style.backgroundColor = 'green';
                console.log('sucess');
            }
        }
        xhr.send();

    }



});
