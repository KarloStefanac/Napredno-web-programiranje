const http = require('http');

const data = JSON.stringify({
    naziv: "Test Project",
    opis: "Testing CRUD",
    cijena: 100,
    datum_pocetka: "2023-01-01"
});

const options = {
    hostname: 'localhost',
    port: 3000,
    path: '/projects',
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Content-Length': data.length
    }
};

const req = http.request(options, res => {
    console.log(`statusCode: ${res.statusCode}`);
    let responseBody = '';

    res.on('data', d => {
        responseBody += d;
    });

    res.on('end', () => {
        console.log('Response:', responseBody);
    });
});

req.on('error', error => {
    console.error(error);
});

req.write(data);
req.end();
