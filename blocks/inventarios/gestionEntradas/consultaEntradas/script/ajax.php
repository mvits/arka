<?php ?>




<script type='text/javascript'>

function marcar(obj) {
    elem=obj.elements;
    for (i=0;i<elem.length;i++)
        if (elem[i].type=="checkbox")
            elem[i].checked=true;
} 

function desmarcar(obj) {
    elem=obj.elements;
    for (i=0;i<elem.length;i++)
        if (elem[i].type=="checkbox")
            elem[i].checked=false;
} 



$(function () {


	$("#<?php echo $this->campoSeguro('selecc_registros')?>").change(function(){

	
		if($("#<?php echo $this->campoSeguro('selecc_registros')?>").val()==1){
			marcar(this.form);
			

		}else{

			desmarcar(this.form);
			}

	      });
});



</script>