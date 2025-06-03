const express = require('express');
const { Kafka, logLevel } = require('kafkajs');

const app = express();
const port = 3000;
app.use(express.json());

// Kafka client
const kafka = new Kafka({
  clientId: 'node-service',
  brokers: ['kafka:9092'],
  logLevel: logLevel.INFO,
  retry: {
    initialRetryTime: 300,
    retries: 10,
  },
});

//const producer = kafka.producer();
//const consumer = kafka.consumer({ groupId: 'node-group' });

// app.get('/api/v1/health-check', (req, res) => {
//     res.json({ message: 'Service 4 is running' });
//   });

// Kafka Producer API
// app.post('/publish', async (req, res) => {
//   const { topic, message } = req.body;

//   try {
//     await producer.connect();
//     await producer.send({
//       topic,
//       messages: [{ value: message }],
//     });
//     await producer.disconnect();

//     res.json({ status: 'Message sent successfully' });
//   } catch (error) {
//     res.status(500).json({ error: error.message });
//   }
// });

// Kafka Consumer


// const consumeMessages = async () => {
 
//   try {
//     await consumer.connect();
//     await consumer.subscribe({ topic: 'my_topic', fromBeginning: true });

//     await consumer.run({
//       eachMessage: async ({ topic, partition, message }) => {
//         console.log(`[Kafka][${topic}] ${message.value.toString()}`);
//       },
//     });

//     console.log('[Kafka] Consumer is running...');
//   } catch (err) {
//     console.error('[Kafka] Consumer error:', err);
//   }
// };

const consumer = kafka.consumer({ groupId: 'node-group' });

const consumeMessages = async () => {
  await consumer.connect();
  await consumer.subscribe({ topic: 'my-topic', fromBeginning: true });

  await consumer.run({
    eachMessage: async ({ topic, partition, message }) => {
      console.log(`[Kafka][${topic}][${partition}] ${message.offset} - ${message.value.toString()}`);
    },
  });
};

setTimeout(() => {
    consumeMessages().catch(console.error);
  }, 15000); // 15 seconds

