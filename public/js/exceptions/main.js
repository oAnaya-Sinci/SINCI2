(async() =>{

  const localeObject = {
    name: 'es', // name String
    weekdays: 'Domingo_Lunes_Martes:Miercoles_Jueves_Viernes_Sabado'.split('_'), // weekdays Array
    weekdaysShort: 'Dom_Lun_Mar_Mie_Jue_Vie_Sab'.split('_'), // OPTIONAL, short weekdays Array, use first three letters if not provided
    weekdaysMin: 'D_L_M-Mi_J_V_S'.split('_'), // OPTIONAL, min weekdays Array, use first two letters if not provided
    weekStart: 1, // OPTIONAL, set the start of a week. If the value is 1, Monday will be the start of week instead of Sunday。
    yearStart: 4, // OPTIONAL, the week that contains Jan 4th is the first week of the year.
    months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'), // months Array
    monthsShort: 'Ene_Feb_Mar_Abr_May_Jun_Jul_Ago_Sep_Oct_Nov_Dic'.split('_'), // OPTIONAL, short months Array, use first three letters if not provided
    ordinal: n => `${n}º`, // ordinal Function (number) => return number + output
    formats: {
      // abbreviated format options allowing localization
      LTS: 'h:mm:ss A',
      LT: 'h:mm A',
      L: 'MM/DD/YYYY',
      LL: 'MMMM D, YYYY',
      LLL: 'MMMM D, YYYY h:mm A',
      LLLL: 'dddd, MMMM D, YYYY h:mm A',
      // lowercase/short, optional formats for localization
      l: 'D/M/YYYY',
      ll: 'D MMM, YYYY',
      lll: 'D MMM, YYYY h:mm A',
      llll: 'ddd, MMM D, YYYY h:mm A'
    },
    relativeTime: {
      // relative time format strings, keep %s %d as the same
      future: 'in %s', // e.g. in 2 hours, %s been replaced with 2hours
      past: '%s ago',
      s: 'a few seconds',
      m: 'a minute',
      mm: '%d minutes',
      h: 'an hour',
      hh: '%d hours', // e.g. 2 hours, %d been replaced with 2
      d: 'a day',
      dd: '%d days',
      M: 'a month',
      MM: '%d months',
      y: 'a year',
      yy: '%d years'
    },
    meridiem: (hour, minute, isLowercase) => {
      // OPTIONAL, AM/PM
      return hour > 12 ? 'PM' : 'AM'
    }
  }

  dayjs.locale('es', localeObject);

  setTimeout(async () => {

    await dataExceptions();
    await dataExceptionDates();

    outLoader();
  }, 1000);
})();

let fillYears = () => {

  let actualYear = new Date().getFullYear();
  let options = "";
  for (let i = actualYear; i >= 2025; i--) {
    options += `<option ${i == actualYear ? 'selected' : ''} value="${i}">${i}</option>`;
  }

  document.querySelector('#slctYear').innerHTML = options;
}

let dataExceptions = async () => {

  let dataExceptions = await fetch(`${urlData}/getDataExceptionTypes`).then(json => json.json()).then(data => data);

  let options = "";
  options += `<option value="-1">Todas las excepciones</option>`;
  dataExceptions.forEach(elem => {
    options += `<option value="${elem.id}">${elem.description_type}</option>`;
  });

  document.querySelector('#slctTipeException').innerHTML = options;
}

let dataExceptionDates = async () => {

  let year = document.querySelector('#slctYear').value;
  let exectiosSelected = document.querySelector('#slctTipeException').value;
  let dataExceptions = await fetch(`${urlData}/getDataExceptionDates?exectionSelected=${exectiosSelected}&year=${year}`).then(json => json.json()).then(data => data);

  fillTableExceptionDates(dataExceptions);
}

let fillTableExceptionDates = dataExceptions => {

  let tbody = "";
  dataExceptions.forEach(elem => {
    tbody += `<tr>
        <td class="text-start text-xs">${dayjs(elem.initDateToIgnore.substring(0, 10)).format('DD MMMM YYYY')}</td>
        <td class="text-start text-xs">${dayjs(elem.endDateToIgnore.substring(0, 10)).format('DD MMMM YYYY')}</td>
        <td class="text-center text-xs">${dayjs(elem.endDateToIgnore.substring(0, 10)).diff(dayjs(elem.initDateToIgnore.substring(0, 10)), 'days') + 1}</td>
        <td class="text-center text-xs">${elem.description_type}</td>
        <td class="text-start text-xs">${elem.description ?? '-'}</td>
        <td class="text-start text-xs">${elem.employee}</td>
        <!-- <td></td> -->
        </tr>`;
  });

  document.querySelector('#exceptions tbody').innerHTML = tbody;
}

document.querySelector('#slctTipeException').addEventListener('change', async function () {

  dataExceptionDates();
});

document.querySelector('#slctYear').addEventListener('change', async function () {

  dataExceptionDates();
});

fillYears();
