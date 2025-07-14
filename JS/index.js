import { img } from './img.js';
//Fecha carga
const fecha = document.getElementById('fecha');
const preformato = new Date();
const formato = `${preformato.getFullYear()}-${(preformato.getMonth() + 1).toString().padStart(2, '0')}-${preformato.getDate().toString().padStart(2, '0')}`;
fecha.value = formato;

// Mostrar/ocultar formatos
document.querySelectorAll('.card-format').forEach(card => {
  card.addEventListener('click', () => {
    document.querySelectorAll('.card-format').forEach(c => c.classList.remove('active'));
    card.classList.add('active');
    document.querySelectorAll('.formato').forEach(f => f.style.display = 'none');
    document.getElementById(card.dataset.target).style.display = 'block';
  });
});

// Helpers
const clear = ids => ids.forEach(id => document.getElementById(id).value = '');

const addRow = (tbody, data) => {
  const tr = document.createElement('tr');
  data.forEach(item => {
    const td = document.createElement('td');
    td.textContent = item;
    tr.appendChild(td);
  });

  // Botón eliminar
  const tdAction = document.createElement('td');
  const btnDelete = document.createElement('button');
  btnDelete.className = 'delete-btn';
  btnDelete.textContent = 'Eliminar';
  tdAction.appendChild(btnDelete);
  tr.appendChild(tdAction);

  tbody.appendChild(tr);
};

const enableDelete = tableId => {
  document.getElementById(tableId).addEventListener('click', e => {
    if (e.target.classList.contains('delete-btn')) {
      e.target.closest('tr').remove();
    }
  });
};

// ----------- Formato 1 -----------
enableDelete('f1-table');
document.getElementById('f1-add').onclick = () => {
  const proveedor = document.getElementById('f1-prov').value.trim();
  const clave = document.getElementById('f1-clave').value.trim();
  const prod = document.getElementById('f1-prod').value.trim();
  const precio = document.getElementById('f1-precio').value.trim();
  const moneda = document.getElementById('f1-moneda').value.trim();
  const accion = document.getElementById('f1-accion').value;


  if (!proveedor || !clave || !prod || !precio || !moneda || !accion) {
    alert('Llena los campos obligatorios');
    validarCamposLista();
  } else {
    addRow(document.querySelector('#f1-table tbody'), [proveedor, clave, prod, precio, moneda, accion]);
    clear(['f1-prov', 'f1-clave', 'f1-prod', 'f1-precio']);
  }
};

// ----------- Formato 2 -----------
enableDelete('f2-table');
document.getElementById('f2-add').onclick = () => {
  const nombre = document.getElementById('f2-nombre').value.trim();
  const mod = document.getElementById('f2-mod').value;
  const pres = document.getElementById('f2-pres').value.trim();
  const sat = document.getElementById('f2-sat').value.trim();
  const tipo = document.getElementById('f2-tipo').value;
  const info = document.getElementById('f2-info').value.trim();

  if (!nombre || !pres || !sat || !tipo || !info) {
    alert('Llena los campos obligatorios');
    validarCamposLista();
  } else {
    addRow(document.querySelector('#f2-table tbody'), [nombre, mod, pres, sat, tipo, info]);
    clear(['f2-nombre', 'f2-pres', 'f2-sat', 'f2-info']);
  }

};

// ----------- Formato 3 -----------
enableDelete('f3-table');
document.getElementById('f3-add').onclick = () => {
  const nombre = document.getElementById('f3-nombre').value.trim();
  const correo = document.getElementById('f3-correo').value.trim();
  const area = document.getElementById('f3-area').value.trim();
  const puesto = document.getElementById('f3-puesto').value.trim();
  const jefe = document.getElementById('f3-jefe').value.trim();
  const sistema = document.getElementById('f3-sistema').value;
  const actividades = document.getElementById('f3-act').value.trim();

  if (!nombre || !correo || !area || !puesto || !jefe || !sistema || !actividades) {
    validarCamposLista();
  } else {
    addRow(document.querySelector('#f3-table tbody'), [nombre, correo, area, puesto, jefe, sistema, actividades]);
    clear(['f3-nombre', 'f3-correo', 'f3-area', 'f3-puesto', 'f3-jefe', 'f3-act']);
  }


};

// ----------- Formato 4 -----------
enableDelete('f4-table');
document.getElementById('f4-add').onclick = () => {
  const tipo = document.getElementById('f4-tipo').value;
  const oc = document.getElementById('f4-oc').value.trim();
  const prov = document.getElementById('f4-prov').value.trim();
  const prods = document.getElementById('f4-producto').value.trim();
  const cant = document.getElementById('f4-cant').value.trim();
  const clave = document.getElementById('f4-clave').value.trim();
  const prev = document.getElementById('f4-prev').value.trim();
  const nuevo = document.getElementById('f4-new').value.trim();
  const just = document.getElementById('f4-just').value.trim();

  if (!tipo || !cant || !oc || !prov || !clave ||!prods || !prev || !nuevo || !just) {
    validarCamposLista();
  } else {
    addRow(document.querySelector('#f4-table tbody'), [tipo, oc, prov, prods, cant, clave, prev, nuevo, just]);
    clear(['f4-cant', 'f4-clave', 'f4-producto', 'f4-prev', 'f4-new', 'f4-just']);
  }


};

document.getElementById('f4-clear').onclick = () => {
  clear([ 'f4-oc', 'f4-prov',]);
}

// ----------- Exportar a PDF -----------
const { jsPDF } = window.jspdf;

document.querySelectorAll('.download').forEach(btn => {
  btn.addEventListener('click', (btn, function (e) {

    // Validar datos del solicitante
    const solicitante = document.getElementById('solicitante').value.trim();
    const puesto = document.getElementById('puesto').value.trim();
    const departamento = document.getElementById('departamento').value.trim();
    const fecha = document.getElementById('fecha').value;
    // Registros  
    const tableId = btn.dataset.table;
    const table = document.getElementById(tableId);
    const filas = table.querySelectorAll('tbody tr');



    //Validación del Solicitante
    if (!solicitante || !puesto || !departamento || !fecha) {
      alert('Llena los campos obligatorios');
      e.preventDefault();
      validarSolicitante();
    } else {
      if (!filas.length > 0) {
        alert('Agrega un registro');
      } else {
        generarPDF();
      }
    }


    //Generar PDF
    function generarPDF() {
      const formato = btn.closest('.formato');
      const tituloFormato = formato.querySelector('h2')?.textContent || 'Formato';

      const headers = [...table.querySelectorAll('thead th')]
        .slice(0, -1)
        .map(th => th.textContent.trim());

      const body = [...table.querySelectorAll('tbody tr')].map(tr =>
        [...tr.querySelectorAll('td')]
          .slice(0, -1)
          .map(td => td.textContent.trim())
      );

      const doc = new jsPDF('p', 'pt', 'a4');
      const margin = 40;
      let y = 60;

      //Estructura del documento
      drawContent();

      function drawContent() {
        const pageWidth = doc.internal.pageSize.getWidth();
        const pageHeight = doc.internal.pageSize.getHeight();

        doc.addImage(img, 'PNG', margin, y, 120, 40);

        // Título centrado
        doc.setFont("helvetica", "bold");
        doc.setFontSize(16);
        const titleLines = doc.splitTextToSize(tituloFormato, 300);
        doc.text(titleLines, 400, y +=10, { align: 'center' });
        y += titleLines.length * 14 + 10;

        // Línea divisoria
        doc.setLineWidth(1.5);
        doc.setDrawColor(127, 127, 127);
        doc.line(margin, y, pageWidth - margin, y);
        y += 16;

        // Datos del solicitante
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(12);
        doc.text('Datos del Solicitante', margin, y); y += 16;

        doc.setFont('helvetica', 'normal');
        doc.setFontSize(12);
        doc.text(`Nombre: ${solicitante}`, margin, y); y += 16;
        doc.text(`Puesto: ${puesto}`, margin, y); y += 16;
        doc.text(`Departamento: ${departamento}`, margin, y); y += 16;
        doc.text(`Fecha: ${fecha}`, margin, y); y += 20;

        // Tabla
        doc.autoTable({
          head: [headers],
          body: body,
          startY: y,
          margin: { left: margin, right: margin },
          styles: { fontSize: 9 },
          headStyles: {
            fillColor: [0, 102, 204],
            textColor: [255, 255, 255]
          },
          bodyStyles: {
            fillColor: [230, 240, 255]
          },
          alternateRowStyles: {
            fillColor: [255, 255, 255]
          }
        });

        if(tableId == 'f3-table'){
          // Firma
            const finalY = pageHeight - 50;
            doc.setFontSize(12);
            doc.text('Firma del Jefe Inmediato:', pageWidth / 2, finalY - 40, { align: 'center' });
            doc.setLineWidth(1);
            doc.setDrawColor(0, 0, 0);
            doc.line(pageWidth / 2 - 90, finalY, pageWidth / 2 + 90, finalY);
        }


        // Guardar PDF
        const fileName = tituloFormato.replace(/[^\w\s]/gi, '').replace(/\s+/g, '_').toLowerCase() + '.pdf';
        doc.save(fileName);
      }
    }



  }));
});


function validarCamposLista() {
  const campos = document.querySelectorAll('input, select, textarea');
  let primerFallo = null;

  campos.forEach(campo => {
    const contenedor = campo.parentElement;


    const mensajeExistente = contenedor.querySelector('.error-message');
    if (mensajeExistente) mensajeExistente.remove();


    if (!campo.value.trim()) {
      const mensaje = document.createElement('div');
      mensaje.classList.add('error-message');
      mensaje.textContent = 'Este campo es obligatorio.';
      contenedor.appendChild(mensaje);

      if (!primerFallo) {
        primerFallo = campo;
      }


      campo.addEventListener('input', function onInput() {
        mensaje.remove();
        campo.removeEventListener('input', onInput);
      });
    }
  });

  if (primerFallo) {
    primerFallo.focus();
    return false;
  }

  return true;
}

function validarSolicitante() {
  const campos = document.querySelectorAll('.validacion');
  let primerFallo = null;

  campos.forEach(campo => {
    const contenedor = campo.parentElement;


    const mensajeExistente = contenedor.querySelector('.error-message');
    if (mensajeExistente) mensajeExistente.remove();


    if (!campo.value.trim()) {
      const mensaje = document.createElement('div');
      mensaje.classList.add('error-message');
      mensaje.textContent = 'Este campo es obligatorio.';
      contenedor.appendChild(mensaje);

      if (!primerFallo) {
        primerFallo = campo;
      }


      campo.addEventListener('input', function onInput() {
        mensaje.remove();
        campo.removeEventListener('input', onInput);
      });
    }
  });

  if (primerFallo) {
    primerFallo.focus();
    return false;
  }

  return true;
}

