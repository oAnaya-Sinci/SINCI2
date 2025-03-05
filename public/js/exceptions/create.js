(async () => {

  let dataTypeExceptions = await fetch(`${urlData}/getDataExceptionTypes`).then(json => json.json()).then(data => data);

  console.warn(dataTypeExceptions);

  setTimeout(async () => {
    outLoader();
  }, 1000);
})()


document.querySelector('.btn-save-exception').addEventListener('click', function () {

  let initDate = document.querySelector('#initDate').value;
  let endDate = document.querySelector('#endDate').value;
  let description = document.querySelector('#description').value;
  let employee = document.querySelector('#employee').value;
  let type = document.querySelector('#type').value;

  let data = {
    initDateToIgnore: initDate,
    endDateToIgnore: endDate,
    description: description,
    employee: employee, 
    description_type: type
  };

  fetch(`${urlData}/addExceptionDate`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  }).then(response => response.json()).then(data => {
    if (data.status) {
      alert('Se ha guardado la excepción');
      window.location.href = '/exception-dates/main';
    } else {
      alert('Error al guardar la excepción');
    }
  });
});

document.querySelector('.btn-cancelate-exception').addEventListener('click', function () {
  window.location.href = '/exception-dates/main';
});

