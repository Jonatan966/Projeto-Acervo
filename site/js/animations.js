function ToggleVisibleControllers(btn){
    //document.all.oi.style.display = 'none'
    if (btn.children[0].className == "fas fa-arrow-down"){
        document.all.mainMusgas.style.visibility = "hidden";
        btn.children[0].className = "fas fa-arrow-up";    
    }
    else {
        document.all.mainMusgas.style.visibility = "";
        btn.children[0].className = "fas fa-arrow-down";   
    }
}