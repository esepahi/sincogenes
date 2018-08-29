__author__ = 'ehsan'
def Extractor (SourceFile, ResultFile):
    fw = open(ResultFile, "w")
    with open(SourceFile) as f:
        first_line = f.readline()
        first_line = first_line.rstrip()
        Mysplit = first_line.split("\t")
        for i in Mysplit:
            if i=="Q=S":
                qequals=Mysplit.index(i)
            elif i==("qseqid"):
                qseqid=Mysplit.index(i)
            elif i==("sseqid"):
                sseqid=Mysplit.index(i)
            elif i==("kNN"):
                kNN=Mysplit.index(i)
            elif i==("Tree"):
                Tree=Mysplit.index(i)
            elif i==("SVM"):
                SVM=Mysplit.index(i)
        fw.write("qseqid"+"\t"+"sseqid"+"\t"+"kNN"+"\t"+"Tree"+"\t"+"SVM"+"\t"+"ensemble"+"\n")
        next(f)
        next(f)
        lines = f.readlines()
        for line in lines:
            templist=[]
            linesplit = line.split("\t")
            if linesplit[qequals]=="1":
                ensemble = "Self"
            else:
                templist.append(linesplit[kNN])
                if linesplit[Tree] in templist:
                    ensemble = linesplit[Tree]
                else:
                    templist.append(linesplit[Tree])
                    if linesplit[SVM] in templist:
                        ensemble = linesplit [SVM]
                    else: ensemble = "Not sure"
            fw.write(linesplit[qseqid]+"\t"+linesplit[sseqid]+"\t"+linesplit[kNN]+"\t"+linesplit[Tree]+"\t"+linesplit[SVM]+"\t"+ensemble+"\n")

Extractor("my.tabular", "testtabularresult.tabular")