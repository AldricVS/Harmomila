function preview(){
    document.getElementById('preview').innerHTML = document.getElementById('article').value;
};

//prévenir la tabulation

var textarea = document.getElementsByTagName("textarea")[0];
    textarea.onkeydown  = function(e){
        console.log(e.key);
        if(e.key == 'Tab'){
            console.log('oui');
            e.preventDefault();
            var s = this.selectionStart;
            this.value = this.value.substring(0,this.selectionStart) + '\t' + this.value.substring(this.selectionEnd);
            this.selectionEnd = s+1;
            return false;
        }
    }
