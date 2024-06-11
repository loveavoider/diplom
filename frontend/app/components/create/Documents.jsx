import {Box} from "@chakra-ui/react";
import {sendGet} from "@/app/util/axios";
import {getClientData, getPurchaseData} from "@/app/util/jurData";
import {useEffect, useState} from "react";
import Doc from "@/app/components/Doc";

const TYPES = {
    1: 'Решение №',
    2: 'Гарантия №'
}

export default function Documents({docs}) {

    return (
        <Box>
            {
                docs.length ?
                docs.map(e => <Doc key={e.id} href={e.path} title={TYPES[e.type] + e.task.toString()} />)
                    : 'Не найдено документов по заявке'
            }
        </Box>
    );
}