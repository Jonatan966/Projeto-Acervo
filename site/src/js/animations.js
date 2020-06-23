function ToggleVisibleControllers(btn){
    //document.all.oi.style.display = 'none'
    if (btn.children[0].className == "fas fa-arrow-down"){
        document.all.mainContainer.style.visibility = "hidden";
        document.all.rangeContainer.style.visibility = "hidden";
        document.all.minimizeContainer.style.borderRadius = "var(--bordaPadrao)";
        btn.children[0].className = "fas fa-arrow-up";    
    }
    else {
        document.all.mainContainer.style.visibility = "";
        document.all.rangeContainer.style.visibility = "";
        btn.children[0].className = "fas fa-arrow-down";   
        document.all.minimizeContainer.style.borderRadius = "0 var(--bordaPadrao) var(--bordaPadrao) 0"; 
    }
}