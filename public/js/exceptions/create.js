(async () => {

  setTimeout(async () => {

    await dataExceptions();

    outLoader();
  }, 1000);
})()

document.querySelector('#slctTipeException').addEventListener('change', async function () {

  let exceptionSelected = document.querySelector('#slctTipeException').value;

  if(exceptionSelected != 1){
    await dataEmployees();
    document.querySelector('#slctEmployee').removeAttribute('disabled');
  } else {
    let options = document.querySelector('#slctEmployee').options ;
    document.querySelector('#slctEmployee').setAttribute('disabled', 'disabled');
    for (let i = options.length - 1; i >= 0; i--) {
      options.remove(i);
    }
  }
});

let dataExceptions = async () => {

  let dataExceptions = await fetch(`${urlData}/getDataExceptionTypes`).then(json => json.json()).then(data => data);

  let options = "";
  dataExceptions.forEach(elem => {
    options += `<option value="${elem.id}">${elem.description_type}</option>`;
  });

  document.querySelector('#slctTipeException').innerHTML = options;
}

let dataEmployees = async () => {

  let dataEmployees = await fetch(`${urlData}/getDataEmployees`).then(json => json.json()).then(data => data);

  let options = "";
  dataEmployees.forEach(elem => {
    // options += `<option value="${elem.Numero_Empleado}">${elem.Numero_Empleado} - ${elem.NOMBRE}</option>`;
    options += `<option value="${elem.Numero_Empleado}">${elem.NOMBRE}</option>`;
  });

  document.querySelector('#slctEmployee').innerHTML = options;
}

document.querySelector('.btn-save-exception').addEventListener('click', async function () {

  inLoader();

  let initDate = document.querySelector('#initDate').value;
  let endDate = document.querySelector('#endDate').value;
  let description = document.querySelector('#description').value;
  let employee = document.querySelector('#slctEmployee').value;
  let typeException = document.querySelector('#slctTipeException').value;

  let data = {
    initDateToIgnore: initDate,
    endDateToIgnore: endDate,
    description: description,
    employee: employee == "" ? NULL : employee,
    description_type: typeException
  };

  let headers = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    };

  await fetch(`${urlData}/addExceptionDate`, headers).then(response => response.json());

  setTimeout(() => {
    window.location.href = '/exception-dates/main';
  }, 1000);
});

document.querySelector('.btn-cancelate-exception').addEventListener('click', function () {
  window.location.href = '/exception-dates/main';
});

