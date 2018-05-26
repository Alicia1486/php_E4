function affiche() {
    var type = '';
    var JSstage = document.getElementById('propStage');
    var JSemploi = document.getElementById('propEmploi');
    var JSstage2 = document.getElementById('propStage2');
    var JSemploi2 = document.getElementById('propEmploi2');
    tabProp = document.getElementsByName('type');
    for (var i = 0; i < 2; i = i + 1)
    {
        if (tabProp[i].checked == true)
            type = tabProp[i].value;
    }
    if (type == "S") {
        JSstage.style.display = 'inline-block';
        JSemploi.style.display = 'none';
        JSstage2.style.display = 'inline-block';
        JSemploi2.style.display = 'none';
    } else if (type == "E") {
        JSemploi.style.display = 'inline-block';
        JSstage.style.display = 'none';
        JSemploi2.style.display = 'inline-block';
        JSstage2.style.display = 'none';
    } else {
        JSstage.style.display = 'none';
        JSemploi.style.display = 'none';
        JSstage2.style.display = 'none';
        JSemploi2.style.display = 'none';
    }
}

