uses System.IO, System.Net, crt;

function httpRequest(url,method:string):string;
    var response:string;
    begin
      var myRequest : HttpWebRequest := HttpWebRequest(WebRequest.Create(url));
      myRequest.Method := method;
      var myResponse : WebResponse := myRequest.GetResponse();
      var sr : StreamReader := new StreamReader(myResponse.GetResponseStream(), System.Text.Encoding.UTF8);
      response := sr.ReadToEnd();
      sr.Close();
      myResponse.Close();
      
      httpRequest := response;
end;

const api_file = '/api.php?';
var lastMsg,responseString,serverAddr,responsePing,nickname,userMsg:string;
isConnected: boolean;

label updateChat;

begin
    clrscr;
    isConnected := false;
    lastmsg := 'none';
    writeln('PasChat ver. 1.0 by Iriscot');
    while not isConnected do begin
        writeln('������� ����� ������� ��� �������� ����� ������� ��� http. ��������, 192.168.0.102');
        readln(serverAddr);
        serverAddr := concat('http://',serverAddr);
        writeln('������� ����������� � �������...');
        responsePing := httpRequest(concat(serverAddr,api_file,'method=ping'), 'GET');
        if((responsePing[1] = 'O') and (responsePing[2] = 'K'))then begin
            writeln('������� ����������.');
            writeln(responsePing);
            isConnected := true;
        end else
            writeln('������ �����������');
    end;
    
    writeln('������� ���: ');
    read(nickname);
    writeln('����� ���������, ',nickname,'. �����.');
    
    updateChat:
       clrscr;
        responseString := httpRequest(concat(serverAddr,api_file,'method=getAll'), 'GET');
        if(responseString <> 'empty')then begin
            writeln(responseString);
            lastMsg := responseString;
        end;
        writeln('������� �����...');
        readln(userMsg);
            if(userMsg = 'exit')then halt()
            else if(userMsg = 'up')then begin writeln('����������...'); goto updateChat; end
            else begin
                httpRequest(concat(serverAddr,api_file,concat('method=send&text=',userMsg,'&user=',nickname)), 'GET');
                goto updateChat;
            end;

end.