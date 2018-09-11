__author__ = 'ehsan'
fw = open('CombTestResultsResults.tabular', "w")

with open('CombTestResults.tabular') as f:
    first_line = f.readline()
    first_line = first_line.rstrip()
    flinesplit = first_line.split("\t")
    print(len(flinesplit))
    mydict = {}
    for item in flinesplit:
        mydict[item]= {item+'-Self-Self':0, item+'-Self-HPD':0, item+'-Self-Paralog':0, item+'-HPD-HPD':0, item+'-HPD-Self':0, item+'-HPD-Paralog':0, item+'-Paralog-Paralog':0, item+'-Paralog-HPD':0, item+'-Paralog-Self':0 }
    lines = f.readlines()
    for line in lines:
        line=line.rstrip()
        linesplit = line.split("\t")
        for i in range(1,27):
            if linesplit[3]=='Self' and linesplit[i]== 'Self':
                mydict[flinesplit[i]][flinesplit[i]+'-Self-Self']= mydict[flinesplit[i]][flinesplit[i]+'-Self-Self']+1
            elif linesplit[3]=='Self' and linesplit[i]== 'HPD':
                mydict[flinesplit[i]][flinesplit[i]+'-Self-HPD']= mydict[flinesplit[i]][flinesplit[i]+'-Self-HPD']+1
            elif linesplit[3]=='Self' and linesplit[i]== 'Paralog':
                mydict[flinesplit[i]][flinesplit[i]+'-Self-Paralog']= mydict[flinesplit[i]][flinesplit[i]+'-Self-Paralog']+1
            elif linesplit[3]=='Paralog' and linesplit[i]== 'Paralog':
                mydict[flinesplit[i]][flinesplit[i]+'-Paralog-Paralog']= mydict[flinesplit[i]][flinesplit[i]+'-Paralog-Paralog']+1
            elif linesplit[3]=='Paralog' and linesplit[i]== 'HPD':
                mydict[flinesplit[i]][flinesplit[i]+'-Paralog-HPD']= mydict[flinesplit[i]][flinesplit[i]+'-Paralog-HPD']+1
            elif linesplit[3]=='Paralog' and linesplit[i]== 'Self':
                mydict[flinesplit[i]][flinesplit[i]+'-Paralog-Self']= mydict[flinesplit[i]][flinesplit[i]+'-Paralog-Self']+1
            elif linesplit[3]=='HPD' and linesplit[i]== 'HPD':
                mydict[flinesplit[i]][flinesplit[i]+'-HPD-HPD']= mydict[flinesplit[i]][flinesplit[i]+'-HPD-HPD']+1
            elif linesplit[3]=='HPD' and linesplit[i]== 'Paralog':
                mydict[flinesplit[i]][flinesplit[i]+'-HPD-Paralog']= mydict[flinesplit[i]][flinesplit[i]+'-HPD-Paralog']+1
            elif linesplit[3]=='HPD' and linesplit[i]== 'Self':
                mydict[flinesplit[i]][flinesplit[i]+'-HPD-Self']= mydict[flinesplit[i]][flinesplit[i]+'-HPD-Self']+1
print(mydict['Q=S'])

#OutPutFile Title
for i in mydict['Q=S']:
    fw.write('\t'+ i[4:])
fw.write(''+'\n')
#OutPuts
for x in mydict:
    fw.write(x + '\t')
    for y in mydict[x]:
        fw.write(str(mydict[x][y])+'\t')
    fw.write('\n')