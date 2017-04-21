import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';

@Injectable()
export class UserApi {

    private baseUrl = 'https://capstone.td9175.com';
    // hard coded email for right now.
    private userid = 'umbcapstone17@gmail.com';
    baseid = encodeURIComponent(this.userid);
    
    public drugToSearch: any;
    public drugToGetDetails: any;
    public fullData: any;
    public user: any;

    constructor(private http: Http) { }

    getUserHSAData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/HealthAccount/hsa/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getUserFSAData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/HealthAccount/fsa/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getUserInfoData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/UserAccount/user/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    // GET request: /UserAccount/user .. if it's logged in, brings up user data: name
    // https://capstone.td9175.com/ci/index.php/HealthAccount/hsa/email/umbcapstone17%40gmail.com
    
    getProductData(){
        return this.http.get(`${this.baseUrl}/ci/index.php/Drugs/search_for_drug/${this.drugToSearch}`).map(res => res.json());
    }

    getProductPrices(){
        return this.http.get(`${this.baseUrl}/ci/index.php/Drugs/price_comparison/${this.drugToGetDetails}`).map(res => res.json());
    }

    
    
    /*Getting Account Details*/
    getHsaTransaction(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/AccountTransaction/hsa_transaction/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getFsaTransaction(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/AccountTransaction/fsa_transaction/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getHsaBalance(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/AccountTransaction/hsa_balance/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    getFsaBalance(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/AccountTransaction/fsa_balance/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }
    
    
    // Firebase test data:
    // private baseUrl = 'https://capstone17-umbhealth-i2.firebaseio.com';
}
 
export class User {
  email: string;
  session: string;
 
  constructor(email: string, session: string) {
    this.email = email;
    this.session = session;
  }
}
 
@Injectable()
export class AuthService {
  currentUser: User;

  constructor(private http: Http) { }
 
  public appLogin(email, password) {
    if (email === null || password === null) {
      return Observable.throw("Please put in your credentials.");
    } else {
      return Observable.create(observer => {
        this.http.post("https://capstone.td9175.com/ci/index.php/UserAccount/login/", body, options);
        this.currentUser = new User(email, session);
        observer.complete();
      });
    }
  }
 
  public appRegisterUser(email, password, first_name, last_name) {
    if (email === null || password === null || first_name === null || last_name === null) {
      return Observable.throw("Please fill out the form.");
    } else {
      return Observable.create(observer => {
        this.http.post("https://capstone.td9175.com/ci/index.php/UserAccount/register/", body, options);
        observer.complete();
      });
    }
  }
 
  public appGetUser() : User {
    return this.currentUser;
  }
 
  public appLogout() {
    return new Promise(resolve => {
        this.currentUser = null;
        this.http.get(`https://capstone.td9175.com/ci/index.php/UserAccount/logout`)
            .subscribe(res => resolve(res.json()));
    });
  }
}