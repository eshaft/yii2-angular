import { Component, OnInit } from '@angular/core';
import {WsService} from "./ws.service";


@Component({
  selector: 'app-ws',
  templateUrl: './ws.component.html',
  styleUrls: ['./ws.component.css']
})
export class WsComponent implements OnInit {

  constructor(private ws: WsService) { }

  ngOnInit() {
      this.ws.connect().subscribe(m => console.log(m))
  }

}
