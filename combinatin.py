__author__ = 'ehsan'

learners = ['K', 'T', 'S', 'G', 'L'] # learners, for example 'K' for kNN learner
learnerResultcols = [ 7, 8, 9, 10, 11]

import itertools

#Combinations
learner1CombsList = list (itertools.combinations (learners, 1)) #All combinations of '1' learners
learner3CombsList = list (itertools.combinations (learners, 3)) #All combinations of '3' learner
learner5CombsList = list (itertools.combinations (learners, 5)) #All combinations of '5' learner

combsNumber = len(learner1CombsList)+len(learner3CombsList)+len(learner5CombsList)

fw = open('CombTestResults.tabular', "w")

#First line of inputfile
with open('30-from17-forBestEnsembleCheck-1000Selfand1000HPDand1000Paralog-randomselected.tabular') as f:
    first_line = f.readline()
    first_line = first_line.rstrip()
    fw.write(first_line)
    for combination in learner1CombsList:
        tempName = ""
        for learner in combination:
            tempName+=str(learner)
        fw.write("\t" + tempName)
    for combination in learner3CombsList:
        tempName = ""
        for learner in combination:
            tempName+=str(learner)
        fw.write("\t" + tempName)
    for combination in learner5CombsList:
        tempName = ""
        for learner in combination:
            tempName+=str(learner)
        fw.write("\t" + tempName)
    fw.write('\n')

    #do folowing for each line>>>
    #for line in myfile:

    lines = f.readlines()
    # lines that q=s all combinations say it is "Self". Note: this will cause bias in your combination accuracy asses
    for line in lines:
        line=line.rstrip()
        linesplit = line.split("\t")
        fw.write(line)
        for combination in learner1CombsList:
            for learner in combination:
                learnerResultCol = learnerResultcols [learners.index(learner)] - 1
                fw.write("\t" + linesplit[learnerResultCol])
        for combination in learner3CombsList:
            tempList = []
            for learner in combination:
                learnerResultCol = learnerResultcols [learners.index(learner)] - 1
                tempList.append(linesplit[learnerResultCol])
            if tempList.count('Self')> tempList.count('HPD') and tempList.count('Self')> tempList.count('Paralog'):
                fw.write("\t" + "Self")
            elif tempList.count('Paralog')> tempList.count('HPD') and tempList.count('Paralog')> tempList.count('Self'):
                fw.write("\t" + "Paralog")
            elif tempList.count('HPD')> tempList.count('Paralog') and tempList.count('HPD')> tempList.count('Self'):
                fw.write("\t" + "HPD")
            else:
                fw.write("\t" + "Not Sure")
        for combination in learner5CombsList:
            tempList = []
            for learner in combination:
                learnerResultCol = learnerResultcols [learners.index(learner)] - 1
                tempList.append(linesplit[learnerResultCol])
            if tempList.count('Self')> tempList.count('HPD') and tempList.count('Self')> tempList.count('Paralog'):
                fw.write("\t" + "Self")
            elif tempList.count('Paralog')> tempList.count('HPD') and tempList.count('Paralog')> tempList.count('Self'):
                fw.write("\t" + "Paralog")
            elif tempList.count('HPD')> tempList.count('Paralog') and tempList.count('HPD')> tempList.count('Self'):
                fw.write("\t" + "HPD")
            else:
                fw.write("\t" + "Not Sure")
        fw.write('\n')
"""
#In this code lines that q=s all combinations say it is "Self". Important Note: this will cause bias in your combination accuracy asses
    for line in lines:
        line=line.rstrip()
        linesplit = line.split("\t")
        if linesplit[0]=="1":
            fw.write(line)
            for i in range(combsNumber):
                fw.write("\t" + "Self")
            fw.write('\n')
        else:
            fw.write(line)
            for combination in learner1CombsList:
                for learner in combination:
                    learnerResultCol = learnerResultcols [learners.index(learner)] - 1
                    fw.write("\t" + linesplit[learnerResultCol])
            for combination in learner3CombsList:
                tempList = []
                for learner in combination:
                    learnerResultCol = learnerResultcols [learners.index(learner)] - 1
                    tempList.append(linesplit[learnerResultCol])
                if tempList.count('Self')> tempList.count('HPD') and tempList.count('Self')> tempList.count('Paralog'):
                    fw.write("\t" + "Self")
                elif tempList.count('Paralog')> tempList.count('HPD') and tempList.count('Paralog')> tempList.count('Self'):
                    fw.write("\t" + "Paralog")
                elif tempList.count('HPD')> tempList.count('Paralog') and tempList.count('HPD')> tempList.count('Self'):
                    fw.write("\t" + "HPD")
                else:
                    fw.write("\t" + "Not Sure")
            for combination in learner5CombsList:
                tempList = []
                for learner in combination:
                    learnerResultCol = learnerResultcols [learners.index(learner)] - 1
                    tempList.append(linesplit[learnerResultCol])
                if tempList.count('Self')> tempList.count('HPD') and tempList.count('Self')> tempList.count('Paralog'):
                    fw.write("\t" + "Self")
                elif tempList.count('Paralog')> tempList.count('HPD') and tempList.count('Paralog')> tempList.count('Self'):
                    fw.write("\t" + "Paralog")
                elif tempList.count('HPD')> tempList.count('Paralog') and tempList.count('HPD')> tempList.count('Self'):
                    fw.write("\t" + "HPD")
                else:
                    fw.write("\t" + "Not Sure")
            fw.write('\n')
"""