function helysegek() {
    $.post(
        "js2/ajax.php",
        {"op" : "helyseg"},
        function(data) {
            $("<option>").val("0").text("Válasszon ...").appendTo("#helysegselect");
            var lista = data.lista;
            for(i=0; i<lista.length; i++)
                $("<option>").val(lista[i].id).text(lista[i].nev).appendTo("#helysegselect");
                //$("<option>").val(lista[i].nev).appendTo("#helysegselect");
        },
        "json"
    );
}


function szallodak() {
    $("#szallodaselect").html("");
    $("#tavaszselect").html("");
    $(".adat").html("");
    var helysegaz= $("#helysegselect").val();
    console.log($("#helysegselect").val());
    if (helysegaz != 0) {
        $.post(
            "js2/ajax.php",
            {"op" : "szalloda", "id" : helysegaz},
            function(data) {
                $("#szallodaselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#szallodaselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
            },
            "json"                                                    
        );
    }
}

function tavaszok() {
    $("#tavaszselect").html("");
    $(".adat").html("");
    var szallodaaz = $("#szallodaselect").val();
    console.log($("#szallodaselect").val());
    if (szallodaaz != null) {
        $.post(
            "js2/ajax.php",
            {"op" : "tavasz", "id" : szallodaaz},
            function(data) {
                $("#tavaszselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                console.log(lista);
                for(i=0; i<lista.length; i++)
                    $("#tavaszselect").append('<option value="'+lista[i].id+'">'+lista[i].indulas+'</option>');
                    console.log(lista);
            },
            "json"                                                    
        );
    }
}

function tavasz() {
    $(".adat").html("");
    // a sorszam valtozo az a tavasz PRIMARY KEY-e
    var sorszam = $("#tavaszselect").val();
    if (sorszam != 0) {
        $.post(
            "js2/ajax.php",
            {"op" : "info", "id" : sorszam},
            function(data) {
                $("#indulas").text(data.indulas);
                $("#idotartam").text(data.idotartam);
                $("#ar").text(data.ar);
            },
            "json"                                                    
        );
    }
}

$(document).ready(function() {
    helysegek();
    
    $("#helysegselect").change(szallodak);
    $("#szallodaselect").change(tavaszok);
    $("#tavaszselect").change(tavasz);
    
    $(".adat").hover(function() {
         $(this).css({"color" : "blue", "background-color" : "black"});
     }, function() {
         $(this).css({"color" : "black", "background-color" : "white"});
     });
 });
