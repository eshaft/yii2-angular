import { Component } from '@angular/core';
import {HttpClient, HttpParams} from "@angular/common/http";
import {Observable} from "rxjs/Observable";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'app';

  constructor(private httpClient: HttpClient) {
    this.getUsers('https://frontend.local/users').subscribe(
        (r) => console.log(r)
    );
  }

  public getUsers(url: string): Observable<any>{
    const options = {params: new HttpParams().set('access-token', '5DBx6qjvcIqx8j1wSlij__3lWDRLwzr5')};
    return this.httpClient.get(url, options);
  }
}
