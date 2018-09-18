__author__ = 'ehsan'
#Important notice: This Code just work with a tabular file that is sorted by qseqid
def Extractor (SourceFile, ResultFile):

    fw = open(ResultFile, "w")

    with open(SourceFile) as f:

        first_line = f.readline()
        first_line = first_line.rstrip()
        Mysplit = first_line.split("\t")
        for i in Mysplit:
            if i=="qseqid":
                qseqid=Mysplit.index(i)
            elif i=="KTS":
                KTS=Mysplit.index(i)
        fw.write("qseqid"+"\t"+"Gene paralogy"+"\n")

        second_line = f.readline()
        second_line = second_line.rstrip()
        mynewsplit = second_line.split("\t")
        geneName=mynewsplit[qseqid]

        lines = f.readlines()
        templist=[]
        for line in lines:
            line = line.rstrip()
            linesplit = line.split("\t")
            if linesplit[qseqid]==geneName:
                templist.append(linesplit[KTS])
            else:
                if "Paralog" in templist:
                    fw.write(geneName+"\t"+"HPG"+"\n")
                elif "HPD" in templist:
                    fw.write(geneName+"\t"+"HPD"+"\n")
                else:
                    fw.write(geneName+"\t"+"SC"+"\n")
                templist=[]
                geneName = linesplit[qseqid]

Extractor("00-Arth-ArthKTSresult.tabular", "00-Arth-ArthPCNresult.tabular")