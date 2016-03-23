document.addEventListener( 'DOMContentLoaded', function () {

  var lebandeau = document.getElementsByClassName('section-title');

  for (item in lebandeau ) {

    var element = lebandeau[item];

    element.addEventListener("click", function(){
      var parent =this.parentNode;
      var icon = this.children[2];

      if(parent.className == "open"){
        icon.className= "icon accordion icon_case-plus";
        parent.className = "";
        parent.style.maxHeight = "42px";
        parent.style.overflow = "hidden";

      }else{
        icon.className= "icon accordion icon_moins";
        parent.className = "open";
        parent.style.maxHeight = "30000px";

      }
    }, false);
  }

}, false );
