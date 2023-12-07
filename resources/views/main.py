import pandas as pd
excel_file_train = 'D:\XAMPP\htdocs\travel\public\public\data.csv'
excel_file_test = 'D:\XAMPP\htdocs\travel\public\public\test.csv'
movies = pd.read_csv(excel_file_train)
movies_test = pd.read_csv(excel_file_test)
name = open("D:\XAMPP\htdocs\travel\public\public\Name.txt",'r',encoding = 'utf-8')

def load_name(name):
    ten_kh=[]
    ten_sp=[]
    ten=''
    X=name.readline()
    for i in range(len(X)):
        if X[i]==',' or X[i]==']':
            ten_kh.append(ten)
            ten=''
        if X[i]!=',' and X[i]!=']' and X[i]!='\n':
            ten=ten+X[i]
    X=name.readline()
    for i in range(len(X)):
        if X[i]==',' or X[i]==']':
            ten_sp.append(ten)
            ten=''
        else:
            ten=ten+X[i]
    return ten_kh,ten_sp
Ten_kh,Ten_sp=load_name(name)
print('Ten_kh: ',Ten_kh)
print('Ten_sp: ',Ten_sp)
count=list(i*0 for i in range(len(Ten_kh)))
def load_date(ID_chu):
    gio=[]
    ID_c=0
    for i in range(len(Ten_kh)):
        if Ten_kh[i]==ID_chu:
            ID_c=i
            
    for i in range(len(Ten_kh)):
        if Ten_kh[i]==ID_chu:
            for j in range(len(movies['Ten khach hang'])):
                if movies['Ten khach hang'][j]==i:
                    for k in range(len(movies['Thoi gian'][j])):
                        if movies['Thoi gian'][j][k:k+1]==':':
                            gio.append(int(movies['Thoi gian'][j][0:k]))
    for j in range(len(gio)):
        for i in range(len(movies['Thoi gian'])):
            for k in range(len(movies['Thoi gian'][i])):
                if movies['Thoi gian'][i][k:k+1]==':':
                    if int(movies['Thoi gian'][i][0:k])==gio[j] and ID_c!=movies['Ten khach hang'][i]:
                        count[movies['Ten khach hang'][i]]+=1
                        
    Max=0
    index=0
    for i in range(len(Ten_kh)):
        if count[i]>Max:
            Max=count[i]
            index=i

    return Ten_kh[index],index         

def Predict(Name):
    Ds_sp=[]
    SP=[]
    Name_Same,Index=load_date(Name)
    for i in range(len(movies_test['Ten khach hang'])):
        if Index==movies_test['Ten khach hang'][i]:
            Ds_sp.append(int(movies_test['San pham mua'][i]))
    for i in range(len(Ds_sp)):
        if Ten_sp[Ds_sp[i]] not in SP:
            SP.append(Ten_sp[Ds_sp[i]])
    print('Cac san pham goi y: ',SP)
                  
Predict('Le')