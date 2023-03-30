import {date} from "quasar";

const datel10n = {
  br: {
    days:['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    daysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
  }
}

function formatDate(dateTime, format) {
  format = format || 'YYYY-MM-DDTHH:mm:ss'
  const formattedDate = date.extractDate( dateTime, format, datel10n.br)
  return `${datel10n.br.days[formattedDate.getDay()]}, ${formattedDate.toLocaleDateString()}` +
    ` às ${formattedDate.getHours()}:${formattedDate.getMinutes().toString().padStart(2,'0')}`
}

function toPersistenceFormat(dateTime, format) {
  dateTime = date.extractDate(dateTime, format, datel10n.br )
  dateTime = date.subtractFromDate(dateTime,{hours: 3})
  dateTime = dateTime.toISOString().split('T')
  return `${dateTime[0]} ${dateTime[1].split('.')[0]}`
}
export {datel10n, formatDate, toPersistenceFormat}
