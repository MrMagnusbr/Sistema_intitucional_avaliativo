const { default: firebase } = require("firebase/compat/app");


const firebaseConfig = {
  apiKey: "AIzaSyAzt_gR5ZAWu9UMEHA_kg34xB75ocKoXx4",
  authDomain: "sistema-avaliativo.firebaseapp.com",
  projectId: "sistema-avaliativo",
  storageBucket: "sistema-avaliativo.firebasestorage.app",
  messagingSenderId: "1015115078657",
  appId: "1:1015115078657:web:3d9f881b1fb1621d813400",
  measurementId: "G-7XGXZ3136J"
};
firebase.initializeApp(firebaseConfig);
const auth = firebase.auth();
const database = firebase.database();