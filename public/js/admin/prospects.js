document.body.onload =()=>{
    console.log('Prospects is ready!');
    document.getElementById('add-new-prospect').style.display="none";

    document.getElementById('add-new-prospect-btn').onclick=()=>{
       if( document.getElementById('add-new-prospect').style.display="none"){
        document.getElementById('add-new-prospect').style.display="block";
       }else{
        document.getElementById('add-new-prospect').style.display="none";
    }
}
   
}