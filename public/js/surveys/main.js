
let dateOptions = {
  hour12: true,
  year: 'numeric',
  month: 'long',
  day: 'numeric',
  hour: 'numeric',
  minute: 'numeric',
  // second: 'numeric'
};

document.addEventListener("DOMContentLoaded", async function (event) {

  let encuestario = Number(window.localStorage.getItem('encuestador'));

  if (encuestario == 1) {
    window.location.href = '/dashboard'
  }

  let obtainDate = (firstDay = false) => {

    let today = new Date().toLocaleDateString('es-MX').split('/').reverse();

    if (firstDay)
      today[2] = '01';
    else if (today[2] < 10)
      today[2] = `0${today[2]}`;

    if (today[1] < 10)
      today[1] = `0${today[1]}`;

    return today.join('-');
  }

  document.querySelector('#date_init').value = obtainDate(true);
  document.querySelector('#date_end').value = obtainDate();

  let dataProyecto = await fetch(urlData + "/obtainDataFromProyects?isLogedIn=" + dataLogin()).then(data => data.json()).then(dataProyecto => {
    return dataProyecto
  }).catch(() => {
    IsLogedIn();
  });

  let options = "<option value=''>Seleccione un proyecto</option>";
  dataProyecto.forEach(elem => {
    options += `<option value="${elem.VALUE_SELECT}">${elem.OPTION_SELECT}</option>`;
  });

  document.querySelector('#dataProjects').innerHTML = options;
  $('.selectpicker').selectpicker('refresh');

  outLoader();

  obtainDataSurvey();
});

document.querySelector('#dataProjects').addEventListener('change', async elem => {

  let idProyecto = elem.srcElement.value;
  let dataOC = (await fetch(`${urlData}/obtainDataClient?idp=${idProyecto}`).then(json => json.json()))[0];

  document.querySelector('#clientName').value = dataOC.RAZON_SOCIAL;
  document.querySelector('#codeProject').value = dataOC.ORDEN_COMPRA;
  document.querySelector('#vendedor').value = dataOC.VENDEDOR;

  document.querySelector('#btnSaveSurvey').removeAttribute('disabled');
});

document.querySelector('#btnSaveSurvey').addEventListener('click', async () => {

  inLoader();

  let validateEmail1 = validateEmailsInput_SINCI(document.querySelector('.emailClient').value);
  let validateEmail2 = validateEmailsInput(document.querySelector('.emailAdditional').value);
  let validateEmail3 = validateEmailsInput(document.querySelector('.emailCC').value);

  if (validateEmail1 || validateEmail2 || validateEmail3) {
    outLoader();

    document.querySelector('.sidebar').style.zIndex = 1;

    setTimeout(() => {
      document.querySelector('.modalsSinciClass').style.zIndex = 2;
      document.querySelector('.modal-backdrop').style.zIndex = 1;
      document.querySelector('.alarmErrorEmails').classList.toggle('showAlarmErrorEmail');
    }, 500);

    setTimeout(() => {
      document.querySelector('.alarmErrorEmails').classList.toggle('showAlarmErrorEmail');
    }, 6000);

    return false;
  }

  let dataSurvey = [];
  document.querySelectorAll('#createNewSurveyModal .modal-body input:not([type = "search"])').forEach(input => {
    dataSurvey.push(input.value);
  });
  document.querySelectorAll('#createNewSurveyModal .modal-body select').forEach(select => {
    dataSurvey.push(select.value);
  });

  let descriptionProject = document.querySelector('.filter-option-inner-inner').innerText;
  descriptionProject = descriptionProject.split(' - ')[1];

  dataSurvey.push(descriptionProject);

  let headers = {
    method: 'POST',
    body: JSON.stringify(dataSurvey),
    headers: {
      "content-type": "application/json; charset=utf-8",
      'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content"),
    }
  };

  let responseSaveData = await fetch(`/surveys/saveDataSurvey`, headers).then(json => json.json());

  $('#createNewSurveyModal').modal('hide');
  $('.selectpicker').val('');
  $('.selectpicker').selectpicker('refresh');
  outLoader();

  if (!responseSaveData.response) {

    setTimeout(() => {

      document.querySelector('.alarmExistSurvey .alert .message').innerHTML = `<p>${responseSaveData.Message} (${responseSaveData.codigo})</p>`;
      document.querySelector('.alarmExistSurvey').classList.toggle('showAlarmExistSurvey');
    }, 1000);

    setTimeout(() => {
      document.querySelector('.alarmExistSurvey').classList.toggle('showAlarmExistSurvey');
    }, 10000);

  } else {
    await obtainDataSurvey();
  }
});

let obtainDataSurvey = async () => {

  let dataFilters = {
    status: document.querySelector('#slctStatus').value,
    date_init: document.querySelector('#date_init').value,
    date_end: document.querySelector('#date_end').value
  }

  let dataSurvey = await fetch(`/surveys/obtainSurveys?dataFilters=${JSON.stringify(dataFilters)}`).then(json => json.json());

  let table = document.querySelector('#tableSurveys tbody');
  try {
    table.querySelector('tr').remove();
  } catch (error) {
    console.warn(error);
  }

  let tbody = "";
  let ordenCompra = null;

  let counter;
  dataSurvey.forEach((elem, i) => {

    let codigo = elem.codigo_proyecto_cliente.replace(/[\s]/, '').substr(0, 8);

    if (elem.orden_compra_cliente != ordenCompra) {

      counter = 0;

      tbody += `<tr><td class="client"> <i class="bx bx-plus" data-orden = "${codigo}"></i> ${elem.nombre_cliente} </td>`;
      tbody += `<td>${elem.codigo_proyecto_cliente}</td>`;
      tbody += `<td>${elem.orden_compra_cliente}</td>`;
      // tbody += `<td class="description">${ elem.descripcion_proyecto_cliente }</td>`;
      tbody += `<td>${elem.correo_cliente}</td>`;
      // tbody += `<td>${ elem.correo_copia === null ? " - " : elem.correo_copia}</td>`;
      // tbody += `<td>${ elem.correo_copia_oculta === null ? " - " : elem.correo_copia_oculta }</td>`;
      tbody += `<td>${elem.estatus_encuesta === 1 ? "Creada" : "Contestada"}</td>`;
      tbody += `<td>${elem.survey_created}</td>`;
      // tbody += `<td>${ elem.nombre_encuesta }</td>`;
      // tbody += `<td>${ elem.descripcion }</td>`;
      tbody += `<td>${elem.survey_answered === null ? ' - ' : elem.survey_answered}</td>`;
      tbody += `<td style="text-align: center !important;"> ${elem.total_resend} </td>`;
      tbody += `<td>${elem.id_llave_encuesta === null ? `<button class="btn btn-primary btn-sm" data-llave="${elem.orden_compra_cliente}"  data-type="reenviar">Reenviar</button>` : `<button class="btn btn-primary btn-sm" data-llave="${elem.id_llave_encuesta}" data-type="pdf">PDF</button>`}</td></tr>`;

      ordenCompra = elem.orden_compra_cliente;

      if(elem.fecha_reenvio != null){

        counter ++;

        tbody += `<tr class = "${codigo} resend_survey non_display"><td colspan = "2" style="text-align: center;">Reenvío de encuesta intento N° ${counter}</td>`;
        tbody += `<td colspan = "7">${new Date(elem.fecha_reenvio).toLocaleDateString('es-MX', dateOptions)}</td></tr>`;
        // tbody += `<td colspan = "5"></td></tr>`;
        ordenCompra = elem.orden_compra_cliente;
      }
    } else {

      counter ++;

      tbody += `<tr class = "${codigo} resend_survey non_display"><td colspan = "2" style="text-align: center;">Reenvío de encuesta intento N° ${counter}</td>`;
      tbody += `<td colspan = "7">${new Date(elem.fecha_reenvio).toLocaleDateString('es-MX', dateOptions)}</td></tr>`;
    //   tbody += `<td colspan = "5"></td></tr>`;
      ordenCompra = elem.orden_compra_cliente;
    }
  });

  table.innerHTML = tbody;

  initiateButtonActions();

  return true;
};

document.querySelector('.btn-filters').addEventListener('click', () => {
  obtainDataSurvey();
});

let initiateButtonActions = () => {

  document.querySelectorAll('#tableSurveys tbody tr:not(.resend_survey)').forEach(tr => {

    tr.querySelector('td .btn').addEventListener('click', async btnClick => {

      if (btnClick.srcElement.dataset.type == 'reenviar') {

        let headers = {
          method: 'POST',
          body: JSON.stringify({ llave: btnClick.srcElement.dataset.llave }),
          headers: {
            "content-type": "application/json; charset=utf-8",
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content"),
          }
        };

        await fetch('/surveys/resend_emails', headers);

        obtainDataSurvey();

      } else {
        let keyReportPDF = btnClick.srcElement.dataset.llave;
        window.open(`/surveys/generatePDFSurveys?idSurvey=${keyReportPDF}&sendEmail=false`, '_blank');
      }
    });

    tr.querySelector('td .bx').addEventListener('click', trBX => {

      let client = trBX.srcElement.dataset.orden;

      trBX.srcElement.classList.toggle('bx-plus');
      trBX.srcElement.classList.toggle('bx-minus');

      document.querySelectorAll(`.${client}.resend_survey`).forEach( elem => {
        elem.classList.toggle('non_display')
      });
    });

  });

  // document.querySelectorAll('#tableSurveys tbody tr td .btn').forEach(btn => {

  //   btn.addEventListener('click', async btnClick => {

  //     if (btn.dataset.type == 'reenviar') {

  //       let headers = {
  //         method: 'POST',
  //         body: JSON.stringify({ llave: btn.dataset.llave }),
  //         headers: {
  //           "content-type": "application/json; charset=utf-8",
  //           'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content"),
  //         }
  //       };

  //       await fetch('/surveys/resend_emails', headers);
  //     } else {
  //       let keyReportPDF = btnClick.srcElement.dataset.llave;
  //       window.open(`/surveys/generatePDFSurveys?idSurvey=${keyReportPDF}&sendEmail=false`, '_blank');
  //     }
  //   });
  // });
};

document.querySelector('#newSurvey').addEventListener('click', () => {

  document.querySelectorAll('#createNewSurveyModal .modal-body input').forEach(input => {
    input.value = "";
  });
  document.querySelectorAll('#createNewSurveyModal .modal-body select').forEach(select => {
    select.value = "";
  });

  $('#createNewSurveyModal').modal('show');
});

let validateEmailsInput_SINCI = emailsString => {

  if (emailsString == '')
    return false;

  let re_email = /\S+@\S+\.\S+/;
  let re_SinciEmail = /sinci.com/i;

  let errorEmailFormat = false;
  emailsString.split(',').map(email => {

    email.trim();

    let checkEmail = re_email.test(email);
    let splitEmail = email.split('@')[1].trim();
    let isEmailSinci = re_SinciEmail.test(splitEmail);

    if (!checkEmail || isEmailSinci) {
      errorEmailFormat = true;
    }
  });

  if (errorEmailFormat) {

    document.querySelector('.sidebar').style.zIndex = 1;

    setTimeout(() => {
      document.querySelector('.modalsSinciClass').style.zIndex = 2;
      document.querySelector('.modal-backdrop').style.zIndex = 1;
      document.querySelector('.alarmErrorEmails').classList.toggle('showAlarmErrorEmail');
    }, 500);

    setTimeout(() => {
      document.querySelector('.alarmErrorEmails').classList.toggle('showAlarmErrorEmail');
    }, 6000);
  }

  return errorEmailFormat;
};

let validateEmailsInput = emailsString => {

  if (emailsString == '')
    return false;

  let re_email = /\S+@\S+\.\S+/;

  let errorEmailFormat = false;
  emailsString.split(',').map(email => {

    email.trim();

    let checkEmail = re_email.test(email);

    if (!checkEmail) {
      errorEmailFormat = true;
    }
  });

  if (errorEmailFormat) {

    document.querySelector('.sidebar').style.zIndex = 1;

    setTimeout(() => {
      document.querySelector('.modalsSinciClass').style.zIndex = 2;
      document.querySelector('.modal-backdrop').style.zIndex = 1;
      document.querySelector('.alarmErrorEmails').classList.toggle('showAlarmErrorEmail');
    }, 500);

    setTimeout(() => {
      document.querySelector('.alarmErrorEmails').classList.toggle('showAlarmErrorEmail');
    }, 6000);
  }

  return errorEmailFormat;
};

document.querySelector('.emailClient').addEventListener('change', input => { validateEmailsInput_SINCI(input.srcElement.value); });
document.querySelector('.emailAdditional').addEventListener('change', input => { validateEmailsInput(input.srcElement.value); });
document.querySelector('.emailCC').addEventListener('change', input => { validateEmailsInput(input.srcElement.value); });
