
/*
import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import 'rxjs/add/operator/map';
*/
/*
  Generated class for the Backand provider.

  See https://angular.io/docs/ts/latest/guide/dependency-injection.html
  for more info on providers and Angular 2 DI.
*/
/*
@Injectable()
export class Backand {

  constructor(public http: Http) {
    console.log('Hello Backand Provider');
  }

}
*/

/*
.config(function (BackandProvider) {
BackandProvider.setAppName('umbhealth');
BackandProvider.setAnonymousToken('338716e4-f6e3-11e6-992f-0e949b6db9c0');
})
*/
//import {ViewChild} from '@angular/core';
//import {Http} from '@angular/http';

/*
import { Injectable } from '@angular/core';
import { Http, Headers } from '@angular/http';
import 'rxjs/add/operator/map';
 
@Injectable()
export class Backand {
  auth_token: {header_name: string, header_value: string} = {header_name: 'AnonymousToken', header_value: 'YOURTOKEN'};
  api_url: string = 'https://api.backand.com';
  app_name: string = 'YOURAPPNAME';
 
  constructor(public http: Http) {}
 
  private authHeader() {
    var authHeader = new Headers();
    authHeader.append(this.auth_token.header_name, this.auth_token.header_value);
    return authHeader;
  }
 
  public getTodos() {
    return this.http.get(this.api_url + '/1/objects/todos?returnObject=true', {
      headers: this.authHeader()
    })
    .map(res => res.json())
  }
 
  public addTodo(name: string) {
    let data = JSON.stringify({name: name});
 
    return this.http.post(this.api_url + '/1/objects/todos?returnObject=true', data,
    {
      headers: this.authHeader()
    })
    .map(res => {
      return res.json();
    });
  }
 
  public removeTodo(id: string) {
    return this.http.delete(this.api_url + '/1/objects/todos/' + id,
    {
      headers: this.authHeader()
    })
    .map(res => {
      return res.json();
    });
  }
}
*/