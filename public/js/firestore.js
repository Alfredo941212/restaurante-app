// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";
import { getFirestore, doc, getDoc, onSnapshot, setDoc } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-firestore.js";

const firebaseConfig = {
  apiKey: "AIzaSyD8tt_JoFGK4KT700V62FWuhWTx30IsNGY",
  authDomain: "awos-548b3.firebaseapp.com",
  projectId: "awos-548b3",
  storageBucket: "awos-548b3.firebasestorage.app",
  messagingSenderId: "693871264545",
  appId: "1:693871264545:web:8f80a1fb5814354d71f460"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const firestore = getFirestore();
console.log("Conectado a firestore")

const invernadero = doc(firestore, 'invernaderos/invernadero1')
async function leeInvernadero() {
  const snapshot = await getDoc(invernadero);
  if (snapshot.exists()) {
    const datos = snapshot.data();
    console.log('Los datos son: ' + JSON.stringify(datos))
    $('#distancia').html('Distancia: ' + datos.distancia + 'Centímetros')
    $('#tiempo').html ('Tiempo: ' + datos.tiempo + 'Minutos')
    $('#riego').prop('checked', datos.riego?true:false)
  }
}

function recibeCambios(){
  onSnapshot(invernadero, (docSnapshot) =>{
    if (docSnapshot.exists()) {
      const datos = docSnapshot.data()
      console.log('Los datos NUEVOS son: ' + JSON.stringify(datos));
      $('#distancia').html('Distancia: ' + datos.distancia + ' Centimetros')
      $('#tiempo').html ('Tiempo: ' + datos.tiempo + ' Minutos')
      $('#riego').prop('checked', datos.riego?true:false)

    }
  })
}


function updateInvernadero(params) {
  const datos ={
    riego: $('#riego').prop('checked')
  }
  setDoc(invernadero, datos, {merge: true});
}
leeInvernadero()
recibeCambios()
window.actualiza = updateInvernadero;