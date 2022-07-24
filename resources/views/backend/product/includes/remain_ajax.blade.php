<script>
    $('#category_id').change(function(){
    var catid = $(this).val();
    $.ajax({
        method: "POST",
        url: "{{route('category.getsubcategory')}}",
        data:{'id':catid},
        success:function (resp){
           $('#subcategory_id').html(resp);
        }
    });
}); 
</script>
