@extends('layout.admin')

<?php $title = "Host contest";?>

@section('page_title')<?php echo $title?>@stop

@section('title')<?php echo $title?>@stop

@section('style')
      <style>
          .preview-images-zone {
    width: 100%;
    border: 1px solid #ddd;
    min-height: 180px;
    padding: 5px 5px 0px 5px;
    position: relative;
    overflow:auto;
}
.preview-images-zone > .preview-image:first-child {
    height: 185px;
    width: 185px;
    position: relative;
    margin-right: 5px;
}
.preview-images-zone > .preview-image {
    height: 90px;
    width: 90px;
    position: relative;
    margin-right: 5px;
    float: left;
    margin-bottom: 5px;
}
.preview-images-zone > .preview-image > .image-zone {
    width: 100%;
    height: 100%;
}

.image-zone{
            background-size: cover;
    background-repeat: no-repeat;
}
.preview-images-zone > .preview-image > .image-zone > img {
    width: 100%;
    height: 100%;
}
.preview-images-zone > .preview-image > .tools-edit-image {
    position: absolute;
    z-index: 100;
    color: #fff;
    bottom: 0;
    width: 100%;
    text-align: center;
    margin-bottom: 10px;
    display: none;
}
.preview-images-zone > .preview-image > .image-cancel {
    font-size: 18px;
    position: absolute;
    top: 0;
    right: 0;
    font-weight: bold;
    margin-right: 10px;
    cursor: pointer;
    display: none;
    z-index: 100;
}
.preview-image:hover > .image-zone {
    cursor: move;
    opacity: .8;
}
.preview-image:hover > .tools-edit-image,
.preview-image:hover > .image-cancel {
    display: block;
}
.ui-sortable-helper {
    width: 90px !important;
    height: 90px !important;
}
      </style>
@stop


@section('content')
        <div class="col-md-6">
                <form method="POST">
                        <div class="form-group">
                                <input type="text" class="form-control" placeholder="Contest name" name="contest_name">
                        </div>
                        <div class="form-group">
                                <textarea type="text" class="form-control" placeholder="Contest description" name="contest_name"></textarea>
                        </div>

                        <label for="prize_section">Add Prize</label>
                        <div id="prize_section">
                                <div class="form-group">
                                                <input type="text"  id="prizeName" class="form-group form-control col-md-7" placeholder="Prize name" name="prize_name">
                                                <textarea type="text" id="prizeDesc" class="form-control col-md-7" placeholder="Prize description" name="prize_desc"></textarea>
                                </div>

                             <fieldset class="form-group">
        <a href="javascript:void(0)" onclick="$('#pro-image').click()" class="btn btn-primary">Upload Prize Images</a>
        <input type="file" id="pro-image" name="pro-image" style="display: none;" class="form-control" multiple>
    </fieldset>
<div class="preview-images-zone">
        
    </div>

                                <br>
                        <div class="form-group">
                                <select class="form-control" id="delivery">
                                        <option value="_">Select Delivery Type</option>
                                        if(!empty($delivery)){
                                                @foreach ($delivery as $item )
                                                    <option>{{$item->type}}</option>
                                                @endforeach
                                        }
                                </select>
                        </div>

                          <div class="btn btn-primary" id="addPrizeBtn">
                                Add Prize
                        </div>
                        </div>
                      
                        <div id="prizes">
                        </div>
                </form>
        </div>
@stop

@section('script')
        <script>
                
$(document).ready(function() {
    document.getElementById('pro-image').addEventListener('change', readImage, false);
       
    $( ".preview-images-zone" ).sortable();





});


 var prizes = [];
 var prizeImages = [];

 var num = 0;
 

function readImage() {
    if (window.File && window.FileList && window.FileReader) {
        var files = event.target.files; //FileList object
        var output = $(".preview-images-zone");

        for (let i = 0; i < files.length; i++) {
            var file = files[i];

            var image = {
                    id: i,
                    image: file,
            }

            prizeImages.push(image);

            console.log(prizeImages.length);
            if (!file.type.match('image')) continue;
            
            var picReader = new FileReader();
            
            picReader.addEventListener('load', function (event) {
                var picFile = event.target;
                var html =  '<div class="preview-image preview-show-' + num + '">' +
                            '<div class="image-cancel" data-no="' + num + '"><i class="fa fa-trash" aria-hidden="true" style="    color: red;margin-top: 10px;"></i></div>' +
                            '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '" style="object-fit:cover"></div>' +
                            '</div>';

                output.append(html);
                num = num + 1;
            });
            picReader.readAsDataURL(file);
        }
        $("#pro-image").val('');
    } else {
        console.log('Browser not support');
    }
}
  $(document).on('click', '.image-cancel', function() {
        let no = $(this).data('no');
        $(".preview-image.preview-show-"+no).remove();
    });

function clearPrizeForm(){
        $('#prizeName').removeAttr('value');
        $('#prizeDesc').removeAttr('value');
        $('#delivery').removeAttr('value');
        prizeImage = [];
}

        $('#addPrizeBtn').on('click',function(){

                var prize = {
                        name : $('#prizeName').val(),
                        desc : $('#prizeDesc').val(),
                        images : prizeImages,
                        delivery : $('#delivery').val(),
                };
prizes.push(prize);

clearPrizeForm();
                alert(prizes.length);
                console.log(prize);
                
        });

  
        </script>
@stop


{{-- var prizes = [];
                        var prizeImages = [];
                        $("#addPrizeBtn").click(function(){
                                prizes.push({
                                name: $("#prizeName").val(),
                                desc: $("#prizeDesc").val(),
                                images: prizeImages,
                        });
                        }); --}}



                        {{-- $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
}); --}}