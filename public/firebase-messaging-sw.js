importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
firebase.initializeApp = {
    apiKey: "AIzaSyD37gVllQcyOItukY933u0pbgw9D09B8t4",
    authDomain: "task-notification-706a8.firebaseapp.com",
    projectId: "task-notification-706a8",
    storageBucket: "task-notification-706a8.appspot.com",
    messagingSenderId: "758918376789",
    appId: "1:758918376789:web:ad52c2755f984dbf2253dc",
    measurementId: "G-NHRS7VJHCJ"
};

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});
