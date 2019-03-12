  <script>
  Dropzone.autoDiscover = false;
  var myDropzone = new Dropzone("#my-dropzone", {
    url: "<?php echo site_url("EditOwnerProfile/productimage_Upload") ?>",
    acceptedFiles: "image/*",
    method:"post",
    addRemoveLinks: true,
    sending: function (file, xhr, formData) {
      var nameimg = file.name;
      var prod_name = $('#productname').val();
      var shopid = <?=$this->session->userdata('Shopid')?>;
      formData.append('nameimg', nameimg);
      formData.append('shopid', shopid);
      formData.append('prod_name', prod_name);
    },
    removedfile: function(file) {
      var name = file.name;
      var prod_name = $('#productname').val();
      var shopid = <?=$this->session->userdata('Shopid')?>;
      $.ajax({
        type: "post",
        url: "<?php echo site_url("EditOwnerProfile/remove") ?>",
        data: { file: name,shopid:shopid,prod_name:prod_name },
        dataType: 'html'
      });

      // remove the thumbnail
      var previewElement;
      return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
    }
    <?php if($product_name != null){ ?>,
    init: function() {
      var me = this;
      var prod_name = $('#productname').val();
      var shopid = <?=$this->session->userdata('Shopid')?>;
      $.get("<?php echo base_url() ?>EditOwnerProfile/list_files/"+shopid+"/"+prod_name+"", function(data) {
        // if any files already in server show all here
        if (data.length > 0) {
          $.each(data, function(key, value) {
            var mockFile = value;
            me.emit("addedfile", mockFile);
            me.emit("thumbnail", mockFile, "<?php echo base_url(); ?>assets/uploads/product_img/shopid"+shopid+"/"+prod_name+"/" + value.name);
            me.emit("complete", mockFile);
          });
        }
      });
    }
    <?php } ?>
  });
  </script>