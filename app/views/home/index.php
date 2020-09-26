<?php $this->start('body'); ?>
<h1 class="text-center red">Welcome To Elite MVC Framework!</h1>
<div onclick="ajaxTest();">Click me!!!</div>

<script>
    function ajaxTest(){
        $.ajax({
            url : '<?=PROOT?>home/testAjax',
            type : "POST",
            data : {model_id : 25},
            success : function(resp){
                if(resp.success){
                    alert(resp.data.name);
                }
                console.log(resp);
            }
        });
    }
</script>
<?php $this->end(); ?>