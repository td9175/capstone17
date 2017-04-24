
export class YelpSearchModel {
    constructor( 
        public term:string,
        public location:string,
        public radius:string,
        public limit:string,
        public token:string
    ) {

    }
}