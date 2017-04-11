import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';

@Injectable()
export class UserApi {

    private baseUrl = 'http://capstone.td9175.com';
    private userid = 19;
    // userid 19 is the test 
    
    public drugToSearch = 'advil';
    public data: any;

    constructor(private http: Http) { }
    // much much better way to do this.
    getUserData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/rest/hsa/id/${this.userid}.json`)
                .subscribe(res => resolve(res.json()));
        });
    }

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