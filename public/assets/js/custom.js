'user strict';

const numberallow = document.getElementsByClassName('allownumber'),
    textallow = document.getElementsByClassName('allowtext');
    let eventsArray = ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"];


setInputFilter(numberallow, function(value){
    return /^-?\d*$/.test(value);
}, "Must be an Number");

setInputFilter(textallow, function(value){
    
    return /^[a-zA-Z ]*$/.test(value);
}, "Must be an Text")

// Number allow
function setInputFilter(textbox, inputFilter, errMsg){

   
    eventsArray.forEach(function(event) {
        let textboxArray = Array.from(textbox);
        textboxArray.forEach(function(textboxes){
            textboxes.addEventListener(event, function(e){

                if(inputFilter(this.value)){

                    // Accepted value
                    if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
                        this.classList.remove("input-error");
                        this.setCustomValidity("");
                    }
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;

                }else if (this.hasOwnProperty("oldValue")) {

                    // Rejected value - restore the previous one
                    this.classList.add("input-error");
                    this.setCustomValidity(errMsg);
                    this.reportValidity();
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);

                }else {
                    this.value = "";
                }

            });
    
        })
    });
   
  
    

   
}
    


