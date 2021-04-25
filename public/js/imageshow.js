function readURL(input) {
    //console.log(input.files);
    //console.log(input.files[0]);

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#objimage')
                    .attr('src', e.target.result)
                    .width(140)
                    .height(117);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }