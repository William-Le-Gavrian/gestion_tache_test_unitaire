import http from 'k6/http';
import { sleep } from 'k6';

export const options = {
    vus: 50,
    iterations: 50,
    duration: '2m'
};

export default async function () {
    http.get('http://127.0.0.1:8080/');
    sleep(1);
}