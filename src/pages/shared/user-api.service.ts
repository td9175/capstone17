import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';

@Injectable()
export class UserApi {

    private baseUrl = 'http://capstone.td9175.com';
    private userid = 'umbcapstone17@gmail.com';
    // for user id.
    // encodeURI(userid);
    baseid = encodeURIComponent(this.userid)
    public drugToSearch = 'advil';
    public data: any;

    constructor(private http: Http) { }
    // much much better way to do this.
    getUserData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/HealthAccount/hsa/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    // GET request: /UserAccount/user .. if it's logged in, brings up user data: name

    // https://capstone.td9175.com/ci/index.php/HealthAccount/hsa/email/umbcapstone17%40gmail.com
    

    getProductData(){
        /*return new Promise(resolve =>{
            this.http.get(`${this.baseUrl}/ci/index.php/Drugs/search_for_drug/${this.drugToSearch}`)
                .subscribe(res => resolve(res.json()));
        });*/

        // don't have the data yet
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/Drugs/search_for_drug/advil`)
                .subscribe(res => resolve(res.json()));
            });
    }

    // this is for testing purposes, working json file stored on firebase.
    // private baseUrl = 'https://capstone17-umbhealth-i2.firebaseio.com';
    /*
    getUserData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/0`)
                .subscribe(res => resolve(res.json()));
        });
    }
*/
} //end export class