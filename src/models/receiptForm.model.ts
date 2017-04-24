export class ReceiptModel {
    constructor(
        public email: string,
        public token: string,
        public accountType: string,
        public totalPrice: string
    ) { }
}