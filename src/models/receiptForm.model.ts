export class ReceiptModel {
    constructor(
        public email: string,
        public token: string,
        public totalPrice: number
    ) { }
}