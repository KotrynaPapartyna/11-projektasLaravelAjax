@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="alert alert-danger error-messages" style="display:none">
            <ul>
            </ul>
        </div>
        <div class="ajaxForm">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Client Name</label>
                <input class="form-control col-md-4" type="text" name="name" id="name" value="test" required/>

                {{-- Klaidos atvaizdavimas/pacioje pradzioje display:none --}}
                <span class="invalid-feedback name" role="alert">
                    <strong>Test</strong>
                </span>

            </div>
            <div class="form-group row">
                <label for="surname" class="col-md-4 col-form-label text-md-right">Client Surname</label>
                <input class="form-control col-md-4" type="text" name="surname" id="surname" value="test" required/>

                <span class="invalid-feedback surname" role="alert">
                    <strong>Test</strong>
                </span>
            </div>
            <div class="form-group row">
                <button class="btn btn-primary" type="submit" id="validate" >Validate</button>
            </div>
        </div>

        <form>
            <input class="form-control col-md-4" type="email" name="name" id="name" value="test" required/>
            <button type="submit">Submit</button>
        </form>

    </div>
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#validate").click(function() {
            var name = $("#name").val();
            var surname = $("#surname").val();
            $.ajax({
            type: 'POST',
            url: '{{route("client.validationstore")}}',
            data: {name: name, surname: surname},
            success: function(data) {
                console.log(data);
                //data.success tik viena
                //alert()
                //jeigu masyve egzistuoja elementas error vadinasi ivyko klaida, jei masyve egzistuoja
                //elementas success vadinasi klaidos nebuvo / jeigu elemento error nera - klaidos nera
                //error neegzistuoja - vadinasi ivyko sekmingai
                if($.isEmptyObject(data.error)) {
                    $(".error-messages").css('display','none');
                    $(".invalid-feedback").css('display','none');
                    alert(data.success);
                } else {
                    //ivyko nesekmignai
                    //error div pasirodo
                    //error divo ul ikeliame visas klaidas
                    $(".error-messages ul").html('');
                    $(".error-messages").css('display','block');
                    //klaida arba klaidos - daugiau negu 1, klaidu masyvas
                    //foreach
                    //foreach (errors as error)
                    $(".invalid-feedback").css('display','none');
                    $.each( data.error, function(key, error) {
                        var errorSpan = "." + key; // surname -> .surname, name -> .name
                        $(errorSpan).css('display', 'block');
                        $(errorSpan).html('');
                        $(errorSpan).append("<strong>"+error+"</strong");
                        $(".error-messages ul").append("<li>"+ error + "-------" + key +"</li>");
                    })
                }
                //data.error klaida/klaidos
                //tos klaidos turi buti atvaizduojamos i error-message diva i sarasa
            }
        });
        });
    </script>
@endsection
