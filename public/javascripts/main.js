window.addEventListener('load',()=>{
    let results = document.getElementsByTagName('dropdown')[0];
    let container = document.getElementsByTagName('container')[0];

    container.addEventListener('click',(evt)=>{
        if(evt.target!==results) results.style.display='none';
    });
});