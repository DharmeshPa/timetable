const fs = require('fs'); // No need to install; it's built into Node.js
const express = require('express');
const https = require('https');
const socketIo = require('socket.io');
const app = express();

app.use(express.json()); // Middleware to parse JSON requests


const server = https.createServer({
    key: fs.readFileSync('privkey.pem'),
  cert: fs.readFileSync('cert.pem'),
  ca: fs.readFileSync('fullchain.pem')
},app);

const io = socketIo(server, {
    cors: {
        origin: "https://pod-laravel.cypherdemo.co.uk", // Allow your Laravel app's domain
        methods: ["GET", "POST"]
    }
});

// Listen for Socket.IO connections
io.on('connection', (socket) => {
    console.log('New client connected:', socket.id);

    socket.on('disconnect', () => {
        console.log('Client disconnected:', socket.id);
    });
});

// HTTP endpoint to receive events from Laravel
app.post('/send-notification', (req, res) => {
    const data = req.body;

    // Broadcast data to all connected clients
    io.emit('message', data);

    res.status(200).send('Notification sent');
});

const PORT = 3000;
server.listen(PORT, () => {
    console.log(`Socket.IO server running on http://localhost:${PORT}`);
});