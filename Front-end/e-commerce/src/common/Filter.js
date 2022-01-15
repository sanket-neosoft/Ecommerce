import moment from 'moment';

const rupee = (num) => ` ₹ ${num}`;

const formatDate = (timestamp) => moment(timestamp).utc().format('Do-MMM-YY');

const formatTime = (timestamp) => moment(timestamp).utc().format('h:mm a');

export {
    rupee,
    formatDate,
    formatTime
};
export default {
    rupee,
    formatDate,
    formatTime
}