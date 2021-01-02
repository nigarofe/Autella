//Função que coleta o filtro desejado.
function applyFilter(pag, status) {
    var url;

    if (pag == 0) {
        url = "http://autella.com/cruds/question/archiveGUI.php?";
    } else {
        url = "http://autella.com/cruds/question/readGUI.php?";
    }

    if (id_role == 1) {
        var discipline_filter = document.getElementById("disciplines");
        discipline_filter = discipline_filter.value;
    } else {
        var discipline_filter = id_discipline;
    }

    var subject_filter = document.getElementById("subjects");
    subject_filter = subject_filter.value;
    var dificulty_filter = document.getElementById("dificulty");
    dificulty_filter = dificulty_filter.value;
    var date_filter = document.getElementById("date");
    date_filter = date_filter.value;

    filters = `${url}filter=true&id_discipline=${discipline_filter}&id_subject=${subject_filter}&dificulty=${dificulty_filter}&date=${date_filter}&status=${status}&`;

    var filter_btn = document.getElementById("filter");
    filter_btn.setAttribute("href", filters);

    if (action_pag == 0) {
        var unarchive_btn = document.getElementById("unarchive");
        unarchive_btn.setAttribute("href", url);
    } else {
        var archive_btn = document.getElementById("archive");
        archive_btn.setAttribute("href", filters);
    }
}

function addFilterInList(selected_filter) {
    if (id_role == 1) {
        var discipline_filter = document.getElementById("disciplines");
        discipline_filter = discipline_filter.value;
    }

    var filter_value = document.getElementById(selected_filter);
    filter_value.setAttribute("disabled", "disabled");
    filter_value = filter_value.value;

    if (filter_value != 'null') {
        switch (selected_filter) {
            case 'disciplines':
                for (let i = 0; i < disciplines.length; i++) {
                    if (disciplines[i][0] == filter_value) {
                        filter_value = disciplines[i][2];
                        console.log(filter_value);
                    }
                }
                break;
            case 'subjects':
                for (let i = 0; i < subjects.length; i++) {
                    if (subjects[i][0] == filter_value) {
                        filter_value = subjects[i][2];
                        console.log(filter_value);
                    }
                }
                break;
            case 'dificulty':
                switch (filter_value) {
                    case '1':
                        filter_value = "Fácil";
                        break;
                    case '2':
                        filter_value = "Média";
                        break;
                    case '3':
                        filter_value = "Difícil";
                        break;
                }
                break;
            case 'date':
                var y = filter_value.split("-")[0];
                var m = filter_value.split("-")[1];
                var d = filter_value.split("-")[2];

                filter_value = `${d + "/" + m + "/" + y}`;
                break; 
        }

        var container_filter = document.getElementsByName("container_filter")[0];

        var label = document.createElement("label");
        label.innerHTML = filter_value;
        container_filter.appendChild(label);

        var img = document.createElement("img");
        img.setAttribute("src", "../../../libraries/bootstrap/bootstrap-icons-1.0.0/x-circle-fill.svg");
        img.setAttribute("alt", "Remover filtro");
        container_filter.appendChild(img);

        container_filter.setAttribute("name", "container_filter_defined");
    }
}