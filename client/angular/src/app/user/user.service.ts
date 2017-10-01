import { Injectable } from '@angular/core';
import {HttpClient, HttpParams} from "@angular/common/http";
import {Observable} from "rxjs/Observable";
import {User} from "./user";

@Injectable()
export class UserService {
  USER_URL: string = 'https://frontend.local/users';

  constructor(private httpClient: HttpClient) { }

  public getUsers(url: string): Observable<any>{
      const options = {params: new HttpParams().set('access-token', '5DBx6qjvcIqx8j1wSlij__3lWDRLwzr5')};
      return this.httpClient.get(url, options);
  }

  public getUserById(id: number): Observable<User>{
      const url = this.USER_URL + '/' + id;
      const params = new HttpParams().set('access-token', '5DBx6qjvcIqx8j1wSlij__3lWDRLwzr5');
      //const headers = new HttpHeaders().set('Authorization', 'Bearer 5DBx6qjvcIqx8j1wSlij__3lWDRLwzr5');
      return this.httpClient.get(url, {params: params})
  }
}
