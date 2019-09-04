document.body.onload =()=>{
    console.log('Edit is ready!');
    let editdetailmodalBtn=document.getElementById('edit-detail-modal-btn')
    let openusermodalBtn=document.getElementById('close-user-model-btn');

    let usermodal=document.getElementById('exampleModal');
    usermodal.style.display="none";
    editdetailmodalBtn.onclick=()=>{
        usermodal.style.display='block';
    }
    openusermodalBtn.onclick=()=>{
        usermodal.style.display='none';
    }
}

 