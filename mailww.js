const express = require('express');
const multer = require('multer');
const nodemailer = require('nodemailer');
const path = require('path');

const app = express();
const port = 3000;

// Configure storage for uploaded files
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, 'uploads'); // Create a directory named "uploads" in the same directory as your server file
  },
  filename: (req, file, cb) => {
    cb(null, file.originalname);
  },
});

const upload = multer({ storage: storage });

app.use(express.static('public')); // Assuming your HTML file is in a "public" directory

app.post('/processForm', upload.single('photo'), (req, res) => {
  const { name, department, year } = req.body;
  const photoPath = req.file ? path.join(__dirname, 'uploads', req.file.originalname) : null;

  // Configure Nodemailer
  const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
      user: 'sridinesht.22msc@kongu.edu', // Replace with your Gmail email address
      pass: '12345678', // Replace with your Gmail password
    },
  });

  // Set up email data
  const mailOptions = {
    from: 'yukeshv.22msc@kongu.edu', // Replace with a valid sender email address
    to: 'yukeshvenkadesh@gmail.com', // Replace with your email address
    subject: 'New Student Form Submission',
    text: `Name: ${name}\nDepartment: ${department}\nYear: ${year}`,
    attachments: photoPath ? [{ path: photoPath }] : [],
  };

  // Send email
  transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
      console.error(error);
      res.status(500).send('Error sending email');
    } else {
      console.log('Email sent: ' + info.response);
      res.status(200).send('Form submitted successfully and email sent.');
    }
  });

  // Cleanup: Delete the uploaded file after sending the email
  if (photoPath) {
    fs.unlinkSync(photoPath);
  }
});

app.listen(port, () => {
  console.log(`Server listening at http://localhost:${port}`);
});
